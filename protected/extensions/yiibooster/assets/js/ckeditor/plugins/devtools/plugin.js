﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.plugins.add("devtools", {lang: "en,bg,cs,cy,da,de,el,eo,et,fa,fi,fr,gu,he,hr,it,nb,nl,no,pl,tr,ug,uk,vi,zh-cn", init: function (i) {
    i._.showDialogDefinitionTooltips = 1
}, onLoad: function () {
    CKEDITOR.document.appendStyleText(CKEDITOR.config.devtools_styles || "#cke_tooltip { padding: 5px; border: 2px solid #333; background: #ffffff }#cke_tooltip h2 { font-size: 1.1em; border-bottom: 1px solid; margin: 0; padding: 1px; }#cke_tooltip ul { padding: 0pt; list-style-type: none; }")
}});
(function () {
    function i(a, c, b, f) {
        var a = a.lang.devtools, j = '<a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.dialog.definition.' + (b ? "text" == b.type ? "textInput" : b.type : "content") + '.html" target="_blank">' + (b ? b.type : "content") + "</a>", c = "<h2>" + a.title + "</h2><ul><li><strong>" + a.dialogName + "</strong> : " + c.getName() + "</li><li><strong>" + a.tabName + "</strong> : " + f + "</li>";
        b && (c += "<li><strong>" + a.elementId + "</strong> : " + b.id + "</li>");
        c += "<li><strong>" + a.elementType + "</strong> : " + j + "</li>";
        return c +
            "</ul>"
    }

    function k(d, c, b, f, j, g) {
        var e = c.getDocumentPosition(), h = {"z-index": CKEDITOR.dialog._.currentZIndex + 10, top: e.y + c.getSize("height") + "px"};
        a.setHtml(d(b, f, j, g));
        a.show();
        "rtl" == b.lang.dir ? (d = CKEDITOR.document.getWindow().getViewPaneSize(), h.right = d.width - e.x - c.getSize("width") + "px") : h.left = e.x + "px";
        a.setStyles(h)
    }

    var a;
    CKEDITOR.on("reset", function () {
        a && a.remove();
        a = null
    });
    CKEDITOR.on("dialogDefinition", function (d) {
        var c = d.editor;
        if (c._.showDialogDefinitionTooltips) {
            a || (a = CKEDITOR.dom.element.createFromHtml('<div id="cke_tooltip" tabindex="-1" style="position: absolute"></div>',
                CKEDITOR.document), a.hide(), a.on("mouseover", function () {
                this.show()
            }), a.on("mouseout", function () {
                this.hide()
            }), a.appendTo(CKEDITOR.document.getBody()));
            var b = d.data.definition.dialog, f = c.config.devtools_textCallback || i;
            b.on("load", function () {
                for (var d = b.parts.tabs.getChildren(), g, e = 0, h = d.count(); e < h; e++) {
                    g = d.getItem(e);
                    g.on("mouseover", function () {
                        var a = this.$.id;
                        k(f, this, c, b, null, a.substring(4, a.lastIndexOf("_")))
                    });
                    g.on("mouseout", function () {
                        a.hide()
                    })
                }
                b.foreach(function (d) {
                    if (!(d.type in{hbox: 1,
                        vbox: 1})) {
                        var e = d.getElement();
                        if (e) {
                            e.on("mouseover", function () {
                                k(f, this, c, b, d, b._.currentTabId)
                            });
                            e.on("mouseout", function () {
                                a.hide()
                            })
                        }
                    }
                })
            })
        }
    })
})();