var express = require('express');
var app = express();
var http = require('http');
var server = http.createServer(app);
var socket = require('socket.io');
var io = socket.listen(server);
app.listen(3000);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel', function(err, count) {

});

redis.on('message', function(channel, message) {
   console.log('Message Recieved: ' + message);

    message = JSON.parse(message);

    io.emit(channel + ':' + message.event, message.data);

});