var dnode = require('dnode'),
	io = require('socks-logger/main.js');

var dnode_server = dnode({
	debug: function (n, cb) {
		cb(true);
		io.sockets.emit('message', n );
	}

});

dnode_server.listen(7070);