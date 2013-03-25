dustjs-slim-rest-app-example
============================

REST App Example unsing PHP Slim and Dust.js frameworks

Mysql -> Slim -> JSON -> Dust.js -> TwitterBootstrap

Functional Requirements:
	- Display a to-do list.
	- I can manipulate my list (add/remove/modify entries).
	- Assign priorities and due dates to the entries.
	- I can sort my entry lists using due date and priority.
	- I can mark an entry as completed.
	- Minimal UI/UX design is needed.
	- I need every client operation done using JavaScript, reloading the page is
	not an option.
	- Write a RESTful API which will allow a third-party application to trigger actions on your app (same actions available on the webpage).


Technical details:
	- 100% rest API (created using PHP slim frame work: http://www.slimframework.com)
	- no page relaod (javascript templating using dust.js: http://linkedin.github.com/dustjs/)

Setup:
	- Edit the server config file at: "api/index.php" line: 130
	- Edit the client config file at: "js/init-layout.js" line: 1

live example at: http://watchdev.com.ar/dustjs-slim-rest-app-example/