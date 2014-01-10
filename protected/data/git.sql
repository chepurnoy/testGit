-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 10 2014 г., 23:03
-- Версия сервера: 5.6.12-log
-- Версия PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `git`
--
CREATE DATABASE IF NOT EXISTS `git` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `git`;

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(280) NOT NULL,
  `dateSend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `dateSend`) VALUES
(1, 'Igore', 'igor@mail.ru', 'subject', 'message', '2013-10-27 09:53:07'),
(2, 'Igore', 'igor@mail.ru', 'subject', 'Message', '2013-11-03 11:55:18'),
(3, 'Igore', 'igor@mail.ru', 'subject', 'Message', '2013-11-09 16:22:31'),
(4, 'sdsds', 'igor@mail.ru', 'subject', 'Mesage', '2013-11-09 16:28:05'),
(5, 'sdsds', 'igor@mail.ru', 'subject', 'sadasd', '2013-11-09 16:30:51'),
(6, 'sdsds', 'igor@mail.ru', 'subject', 'sadsds', '2013-11-09 16:33:37'),
(7, 'sdsds', 'igor@mail.ru', 'subject', 'Message', '2013-11-09 16:36:50'),
(8, 'sdsds', 'igor@mail.ru', 'subject', 'Message', '2013-11-09 17:14:33'),
(9, 'sdsd', 'igor@mail.ru', 'subject', 'Messga', '2013-11-09 17:21:57'),
(10, 'Igore', 'igor@mail.ru', 'subject', 'sdsdsadas', '2013-11-09 20:02:35'),
(11, 'sdsds', 'igor@mail.ru', 'subject', 'Message', '2013-11-13 14:58:12'),
(12, 'sdsds', 'igor@mail.ru', 'subject', 'Mesage', '2013-11-13 14:58:47'),
(13, 'sdsds', 'igor@mail.ru', 'subject', 'Message', '2013-11-13 15:00:34'),
(14, 'Igore', 'igor@mail.r', 'subject', 'Message', '2013-11-13 15:55:50'),
(15, 'sad', 'igor@mail.ru', 'subject', 'asdas', '2014-01-10 20:59:16'),
(16, 'sdsds', 'igor@mail.ru', 'subject', 'message', '2014-01-10 22:15:07'),
(17, 'sdsds', 'igor@mail.ru', 'subject', 'message', '2014-01-10 22:15:29');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `ipUser` varchar(30) NOT NULL,
  `userIdLike` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`ipUser`, `userIdLike`, `createdTime`) VALUES
('127.0.0.1', 3451238, '2014-01-10 20:23:07'),
('127.0.0.1', 7869357, '2014-01-10 20:23:41'),
('127.0.0.1', 47294, '2014-01-10 20:41:24'),
('127.0.0.1', 993322, '2014-01-10 22:17:58');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` char(50) NOT NULL,
  `title` char(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `link`, `title`, `content`) VALUES
(1, 'about', 'About Git', '<h2>Branching and Merging</h2><p>\r\nThe Git feature that really makes it stand apart from nearly every other SCM out there is its branching model.</p><p>\r\nGit allows and encourages you to have multiple local branches that can \r\nbe entirely independent of each other. The creation, merging, and \r\ndeletion of those lines of development takes seconds.</p><p>\r\nThis means that you can do things like:</p><ul><li>\r\n<strong>Frictionless Context Switching</strong>. Create a branch to try \r\nout an idea, commit a few times, switch back to where you branched from,\r\n apply a patch, switch back to where you are experimenting, and merge it\r\n in.\r\n</li><li>\r\n<strong>Role-Based Codelines</strong>. Have a branch that always \r\ncontains only what goes to production, another that you merge work into \r\nfor testing, and several smaller ones for day to day work.\r\n</li><li>\r\n<strong>Feature Based Workflow</strong>. Create new branches for each \r\nnew feature you''re working on so you can seamlessly switch back and \r\nforth between them, then delete each branch when that feature gets \r\nmerged into your main line.\r\n</li><li>\r\n<strong>Disposable Experimentation</strong>. Create a branch to \r\nexperiment in, realize it''s not going to work, and just delete it - \r\nabandoning the work—with nobody else ever seeing it (even if you''ve \r\npushed other branches in the meantime).\r\n</li></ul><p>\r\n<img src="http://git-scm.com/images/about/branches@2x.png" alt="Branches" height="288" width="500"></p><p>\r\nNotably, when you push to a remote repository, you do not have to push \r\nall of your branches. You can choose to share just one of your branches,\r\n a few of them, or all of them. This tends to free people to try new \r\nideas without worrying about having to plan how and when they are going \r\nto merge it in or share it with others.</p><p>\r\nThere are ways to accomplish some of this with other systems, but the \r\nwork involved is much more difficult and error-prone. Git makes this \r\nprocess incredibly easy and it changes the way most developers work when\r\n they learn it.</p>'),
(3, 'distributed', 'Distributed', '<h2>Distributed</h2><p>\r\nOne of the nicest features of any Distributed SCM, Git included, is that\r\n it''s distributed. This means that instead of doing a "checkout" of the \r\ncurrent tip of the source code, you do a "clone" of the entire \r\nrepository.</p><h3>Multiple Backups</h3><p>\r\nThis means that even if you''re using a centralized workflow, every user \r\nessentially has a full backup of the main server. Each of these copies \r\ncould be pushed up to replace the main server in the event of a crash or\r\n corruption. In effect, there is no single point of failure with Git \r\nunless there is only a single copy of the repository.</p><h3>Any Workflow</h3><p>\r\nBecause of Git''s distributed nature and superb branching system, an \r\nalmost endless number of workflows can be implemented with relative \r\nease.</p><h4>Subversion-Style Workflow</h4><p>\r\nA centralized workflow is very common, especially from people \r\ntransitioning from a centralized system. Git will not allow you to push \r\nif someone has pushed since the last time you fetched, so a centralized \r\nmodel where all developers push to the same server works just fine.</p><p>\r\n<img src="http://git-scm.com/images/about/workflow-a@2x.png" alt="Workflow A" height="209" width="415"></p><h4>Integration Manager Workflow</h4><p>\r\nAnother common Git workflow involves an integration manager — a single \r\nperson who commits to the ''blessed'' repository. A number of developers \r\nthen clone from that repository, push to their own independent \r\nrepositories, and ask the integrator to pull in their changes. This is \r\nthe type of development model often seen with open source or GitHub \r\nrepositories.</p><p>\r\n<img src="http://git-scm.com/images/about/workflow-b@2x.png" alt="Workflow B" height="164" width="407"></p><h4>Dictator and Lieutenants Workflow</h4><p>\r\nFor more massive projects, a development workflow like that of the Linux\r\n kernel is often effective.\r\nIn this model, some people (''lieutenants'') are in charge of a specific \r\nsubsystem of the project and they merge in all changes related to that \r\nsubsystem. Another integrator (the ''dictator'') can pull changes from \r\nonly his/her lieutenants and then push to the ''blessed'' repository that \r\neveryone then clones from again.</p><p>\r\n<img src="http://git-scm.com/images/about/workflow-c@2x.png" alt="Workflow C" height="303" width="562"></p>'),
(4, 'small-and-fast', 'Small and Fast', '<h2>Small and Fast</h2><p>\r\n<strong>Git is fast</strong>. With Git, nearly all operations are \r\nperformed locally, giving it a huge speed advantage on centralized \r\nsystems that constantly have to communicate with a server somewhere.</p><p>\r\nGit was built to work on the Linux kernel, meaning that it has had to \r\neffectively handle large repositories from day one. Git is written in C,\r\n reducing the overhead of runtimes associated with higher-level \r\nlanguages. Speed and performance has been a primary design goal of the \r\nGit from the start.</p><h3>Benchmarks</h3><p>\r\nLet''s see how common operations stack up against\r\nSubversion, a common centralized version control system that is similar\r\nto CVS or Perforce. <em>Smaller is faster.</em></p>\r\n<table>\r\n<tbody><tr>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.649,2.6&chds=0,2.6&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Commit%20A" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:1.53,24.7&chds=0,24.7&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Commit%20B" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.257,1.09&chds=0,1.09&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Diff%20Curr" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.248,3.99&chds=0,3.99&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Diff%20Rec" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:1.17,83.57&chds=0,83.57&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Diff%20Tags" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git*%7Cgit%7Csvn&chd=t:21.0,107.5,14.0&chds=0,107.5&chs=100x125&chco=E09FA0%7CE09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Clone" alt="init benchmarks">\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.012,0.381&chds=0,0.381&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Log%20%2850%29" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.519,169.197&chds=0,169.197&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Log%20%28All%29" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.601,82.843&chds=0,82.843&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Log%20%28File%29" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:0.896,2.816&chds=0,2.816&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Update" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:1.91,3.04&chds=0,3.04&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Blame" alt="init benchmarks">\r\n</td>\r\n<td>\r\n<img src="http://chart.apis.google.com/chart?chxt=x&cht=bvs&chl=git%7Csvn&chd=t:181,132&chds=0,181&chs=100x125&chco=E09FA0%7CE05F49&chf=bg,s,fcfcfa&chtt=Size" alt="init benchmarks">\r\n</td>\r\n</tr>\r\n</tbody></table><p>\r\nFor testing, large AWS instances were set up in the same availability zone.\r\nGit and SVN were installed on both machines, the Ruby repository was copied to\r\nboth Git and SVN servers, and common operations were performed on both.</p><p>\r\nIn some cases the commands don''t match up exactly. Here, matching on the lowest\r\ncommon denominator was attempted. For example, the ''commit'' tests also include\r\nthe time to push for Git, though most of the time you would not actually be pushing\r\nto the server immediately after a commit where the two commands cannot be separated\r\nin SVN.</p><p>\r\nAll of these times are in seconds.</p>\r\n<table>\r\n<tbody><tr>\r\n<th>Operation</th>\r\n\r\n<th>Git</th>\r\n<th>SVN</th>\r\n</tr>\r\n<tr><td>Commit Files (A)</td><td>Add, commit and push 113 modified files (2164+, 2259-)</td>\r\n</tr><tr><td>Commit Images (B)</td><td>Add, commit and push 1000 1k images</td>\r\n</tr><tr><td>Diff Current</td><td>Diff 187 changed files (1664+, 4859-) against last commit</td>\r\n</tr><tr><td>Diff Recent</td><td>Diff against 4 commits back (269 changed/3609+,6898-)</td>\r\n</tr><tr><td>Diff Tags</td><td>Diff two tags against each other (v1.9.1.0/v1.9.3.0 )</td>\r\n</tr><tr><td>Log (50)</td><td>Log of the last 50 commits (19k of output)</td>\r\n</tr><tr><td>Log (All)</td><td>Log of all commits (26,056 commits - 9.4M of output)</td>\r\n</tr><tr><td>Log (File)</td><td>Log of the history of a single file (array.c - 483 revs)</td>\r\n</tr><tr><td>Update</td><td>Pull of Commit A scenario (113 files changed, 2164+, 2259-)</td>\r\n</tr><tr><td>Blame</td><td>Line annotation of a single file (array.c)</td>\r\n</tr></tbody></table><p>\r\nNote that this is the best case scenario for SVN - a server with no load with an\r\n80MB/s bandwidth connection to the client machine.  Nearly all of these\r\ntimes would be even worse for SVN if that connection was slower, while\r\nmany of the Git times would not be affected.</p><p>\r\nClearly, in many of these common version control operations, <strong>Git is\r\none or two orders of magnitude faster than SVN</strong>, even under ideal conditions\r\nfor SVN.</p><p>\r\nOne place where Git is slower is in the initial clone operation.\r\nHere, Git is downloading the entire history rather than only the latest\r\nversion. As seen in the above charts, it''s not considerably slower for an operation\r\nthat is only performed once.</p>\r\n<table>\r\n<tbody><tr>\r\n<th>Operation</th>\r\n\r\n<th>Git*</th>\r\n<th>Git</th>\r\n<th>SVN</th>\r\n</tr>\r\n<tr><td>Clone</td><td>Clone and shallow clone(*) in Git vs checkout in SVN</td>\r\n</tr><tr><td>Size (M)</td><td>Size of total client side data and files after clone/checkout (in M)</td>\r\n</tr></tbody></table><p>\r\nIt''s also interesting to note that the size of the data on the client side\r\nis very similar even though Git also has every version of every file for the\r\nentire history of the project. This illustrates how efficient it is at compressing\r\nand storing data on the client side.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `type`, `avatar`, `password`, `lastLogin`, `dateCreate`) VALUES
(27, 'igor', 'chepurnoy', 'igorchepurnoy@mail.ru', 'user', 'yii-framework-wallpaper3.jpg', '4297f44b13955235245b2497399d7a93', NULL, '2014-01-10 22:29:01'),
(28, 'igorek', 'chepurnoy', 'chepurnoy@mail.ru', 'admin', 'Fish-hd-walllpaper-1080.jpg', '4297f44b13955235245b2497399d7a93', NULL, '2014-01-10 22:32:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
