var socket = new WebSocket("ws://localhost:8000/index.php");

let btnCreateDOM = document.getElementById("btn-create");
let btnConnectDOM = document.getElementById("btn-connect");


btnCreateDOM.addEventListener("click", () => {
    socket.send(JSON.stringify({
        requestType: "createRoom"
    }));
});

btnConnectDOM.addEventListener("click", () => {
    let id = prompt("Enter Id of room");

    redirectTo(`game/play?roomId=${id}`);
});


socket.onmessage = (msg) => {
    let data = JSON.parse(msg.data);

    if (data.responseType == 'createRoomResponse') {
        console.log("createRoomResponse");

        redirectTo(`game/play?roomId=${data.data}`);

        return;
    }

    console.log(msg);
}


function redirectTo(to) {
    window.location.href = `http://${window.location.hostname}:8080/${to}`;
}