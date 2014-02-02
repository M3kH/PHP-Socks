var forever = require('forever-monitor');

var child = new (forever.Monitor)('main.js', {
	max : 3,
	silent : true,
	watchDirectory: "/vagrant/",
	logFile: '/vagrant/forever.log',
	options : []
});

child.on('exit', function() {
	console.log('your-filename.js has exited after 3 restarts');
});

child.start();