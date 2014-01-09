﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.plugins.add("iframedialog", {requires: "dialog", onLoad: function () {
    CKEDITOR.dialog.addIframe = function (e, d, a, j, f, l, g) {
        a = {type: "iframe", src: a, width: "100%", height: "100%"};
        a.onContentLoad = "function" == typeof l ? l : function () {
            var a = this.getElement().$.contentWindow;
            if (a.onDialogEvent) {
                var b = this.getDialog(), c = function (b) {
                    return a.onDialogEvent(b)
                };
                b.on("ok", c);
                b.on("cancel", c);
                b.on("resize", c);
                b.on("hide", function (a) {
                    b.removeListener("ok", c);
                    b.removeListener("cancel", c);
                    b.removeListener("resize", c);
                    a.removeListener()
                });
                a.onDialogEvent({name: "load", sender: this, editor: b._.editor})
            }
        };
        var h = {title: d, minWidth: j, minHeight: f, contents: [
            {id: "iframe", label: d, expand: !0, elements: [a]}
        ]}, i;
        for (i in g)h[i] = g[i];
        this.add(e, function () {
            return h
        })
    };
    (function () {
        var e = function (d, a, j) {
            if (!(3 > arguments.length)) {
                var f = this._ || (this._ = {}), e = a.onContentLoad && CKEDITOR.tools.bind(a.onContentLoad, this), g = CKEDITOR.tools.cssLength(a.width), h = CKEDITOR.tools.cssLength(a.height);
                f.frameId = CKEDITOR.tools.getNextId() + "_iframe";
                d.on("load", function () {
                    CKEDITOR.document.getById(f.frameId).getParent().setStyles({width: g, height: h})
                });
                var i = {src: "%2", id: f.frameId, frameborder: 0, allowtransparency: !0}, k = [];
                "function" == typeof a.onContentLoad && (i.onload = "CKEDITOR.tools.callFunction(%1);");
                CKEDITOR.ui.dialog.uiElement.call(this, d, a, k, "iframe", {width: g, height: h}, i, "");
                j.push('<div style="width:' + g + ";height:" + h + ';" id="' + this.domId + '"></div>');
                k = k.join("");
                d.on("show", function () {
                    var b = CKEDITOR.document.getById(f.frameId).getParent(),
                        c = CKEDITOR.tools.addFunction(e), c = k.replace("%1", c).replace("%2", CKEDITOR.tools.htmlEncode(a.src));
                    b.setHtml(c)
                })
            }
        };
        e.prototype = new CKEDITOR.ui.dialog.uiElement;
        CKEDITOR.dialog.addUIElement("iframe", {build: function (d, a, j) {
            return new e(d, a, j)
        }})
    })()
}});