var admin = require("firebase-admin");
var serviceAccount = require("felipe-29121-firebase-adminsdk-pdax3-8b817bf81f.json");



admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: "https://felipe-29121.firebaseio.com"
});

// server side, solo es un ejemplo no esta optimizado




var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
/*
app.get('/', function(req, res){
  res.sendFile();
});*/
app.get('/', function(req, res){
  res.send('<h1>GET</h1>');
});

io.on('connection', function(socket){
  console.log('a user connected');



});

http.listen(3000, function(){
  console.log('listening on *:3000');
});

/*
io.emit('some event', { for: 'everyone' });


io.on('connection', function(socket){
  socket.broadcast.emit('hi');
});
*/
io.on('connection', function(socket){
socket.on('chat message', function(msg){
  console.log('message: ' + msg);
io.emit('chat message', 'hola mundo desde node');
});
});


/*
var io      = require('socket.io').listen(8000);

server.listen(8000, function() {
	console.log('Servidor corriendo en http://localhost:8000');
});
*/

//var mysql   = require('mysql');
//console.log(io);
/*
io.sockets.on('connection', function ( socket ) {
    // cada vez que un cliente se conecta, hacemos un interval cada 3 segundos
    socket.interval =   setInterval(function(){
                            //sendDbdatatoClient( socket );
                            console.log(socket);
                        } , 3000);

    socket.on('disconnect' , function(){
        if( socket.interval ){
            clearInterval( socket.interval );
        }
    });

    function sendDbdatatoClient( client ){
        // utiliza mysql module , debes estudiar como funciona
        // data es un objeto que obtenemos de la base de datos
        client.emit.json( 'db_results' , otra() );
    }
  });*/


/*
admin.auth().createUser({
  email: "user@example.com",
  emailVerified: false,
  phoneNumber: "+11234567890",
  password: "secretPassword",
  displayName: "John Doe",
  photoURL: "http://www.example.com/12345678/photo.png",
  disabled: false
})
  .then(function(userRecord) {
    // See the UserRecord reference doc for the contents of userRecord.
    console.log("Successfully created new user:", userRecord.uid);
  })
  .catch(function(error) {
    console.log("Error creating new user:", error);
  });
*/
function otra(){

  admin.auth().getUserByEmail('user@example.com')
    .then(function(userRecord) {
      // See the UserRecord reference doc for the contents of userRecord.
      console.log("Successfully fetched user data:", userRecord.toJSON());
    })
    .catch(function(error) {
      console.log("Error fetching user data:", error);
    });
   console.log(1);
}




/*
var express =   require('express'),
    http =      require('http'),

    server =    http.createServer(app);

var app = express();

const redis =   require('redis');
//const io =      require('socket.io');
const client =  redis.createClient();

server.listen(3000);
console.log("Listening.....");

io.listen(server).on('connection', function(client) {
    const redisClient = redis.createClient();

    redisClient.subscribe('messages');

    console.log("Redis server running.....");

    redisClient.on("message", function(channel, message) {
        console.log(message);
        client.emit(channel, message);
    });

    client.on('disconnect', function() {
        redisClient.quit();
    });


});*/
