let state = { target: null }

class Card {
    constructor(
        name = "ABOBA",
        imgUrl = "https://upload.wikimedia.org/wikipedia/uk/1/1d/Superman-costume-action-comics-1000.jpg",
        damage = 100,
        hp = 100
    ) {
        this.name = name;
        this.imgUrl = imgUrl;
        this.hp = hp;
        this.damage = damage;
    }
}

class Game {
    constructor(user1, user2) {
        this.user1 = user1;
        this.user2 = user2;

        this.userTurn = this.user1;
    }
}

class User {
    constructor(username, imgUrl, hp) {
        this.username = username;
        this.imgUrl = imgUrl;
        this.hp = hp;

    }
}

let my, enemy;

let cardDeck = [
    new Card(
        "Popug",
        "https://minecrafty.xyz/wp-content/uploads/2017/10/150px-%D0%B0%D0%BF%D0%B0.png",
        20,

    ),
    new Card(
        "Bee",
        "https://static.wikia.nocookie.net/minecraft_ru_gamepedia/images/a/a6/%D0%9F%D1%87%D0%B5%D0%BB%D0%B0.png/revision/latest/scale-to-width-down/705?cb=20190823081609",
        50
    ),
    new Card(
        "Утопленник",
        "https://static.wikia.nocookie.net/minecraft-mojang/images/2/25/%D0%A3%D1%82%D0%BE%D0%BF%D0%BB%D0%B5%D0%BD%D0%BD%D0%B8%D0%BA.png/revision/latest?cb=20180927132518&path-prefix=ru",
        20
    ),
    new Card(
        "Steve",
        "https://static.turbosquid.com/Preview/2016/03/18__12_04_37/MinecraftSteve3dmodel01.jpg2eb1a973-07fd-4dab-b0c7-1c607d93be33Large.jpg",
        10
    ),


    new Card(
        "Creeper",
        "https://static.turbosquid.com/Preview/2016/03/14__23_58_21/MinecraftCreeper02.jpg2a29f0cd-04de-4935-998b-8fe7735414efLarge.jpg",
        30,

    ),
    new Card(
        "Bob",
        "https://www.meme-arsenal.com/memes/ffeabc09a373495bc825f1cce57fc6de.jpg",
        80
    ),
    new Card(
        "Ocelot",
        "https://games.mail.ru/hotbox/content_files/article/32014/lead_pic/6064c.jpeg",
        20
    ),
    new Card(
        "Rosomaha",
        "https://upload.wikimedia.org/wikipedia/ru/d/d9/Wolverine_x.jpg",
        10
    ),




    new Card(
        "Zombie",
        "https://freepngimg.com/thumb/minecraft/9-2-minecraft-zombie-png.png",
        20,

    ),
    new Card(
        "Enderman",
        "http://sun9-27.userapi.com/c5253/g37212106/a_d5b41728.jpg",
        30
    ),
    new Card(
        "Witch",
        "https://toppng.com/uploads/preview/minecraft-witch-cartoo-115638942358mn9zogsqa.png",
        20
    ),
    new Card(
        "Rosomaha",
        "https://ru-minecraft.ru/uploads/posts/2011-10/1320003383_450px-blaze01.png",
        70
    ),
];

let waitingMsgDOM = document.getElementsByClassName("waiting-msg")[0];

let isGameStarted = false;

let myCardDeckSlotDOM = document.getElementById("my-deck-slot");
let enemyCardDeckSlotDOM = document.getElementById("enemy-deck-slot");

let enemyCardsHandDOM = document.getElementsByClassName("enemy-card-hand")[0];
let myCardsHandDOM = document.getElementsByClassName("my-card-hand")[0];

let enemyCards = [];
let myCards = [];

let myCardDesk = null;
let enemyCardDesk = null;

let myHpDOM = document.querySelector("#my-avatar span");
let enemyHpDOM = document.querySelector("#enemy-avatar span");


var socket = new WebSocket("ws://localhost:8000/index.php");

let usersList = [];

let usersListDOM = document.getElementById('conn-users-list');
let roomId = findGetParameter('roomId');

socket.onopen = (msg) => {
    socket.send(JSON.stringify({
        'requestType': 'connectToRoom',
        'roomId': roomId
    }));
}

socket.onmessage = (msg) => {
    let response = JSON.parse(msg.data);
    let data = JSON.parse(response.data);
    console.log("connectedfirst");
    if (response.responseType == 'connectToRoomResponse') {
        console.log(data);

        my = new Card("Aboba", "", 100);

        data.users.forEach(user => {
            usersList.push({ userId: user.userId, username: user.username });
        });


        if (usersList.length == 2) {
            isGameStarted = true;
            console.log("connected");
            startGame();
        }

        return;
    }

    if (response.responseType == 'userConnectedResponse') {
        usersList.push({ userId: data.userId, username: data.username });
        console.log(usersList.length);


        enemy = new Card("Aboba", "", 100);

        if (usersList.length == 2) {
            isGameStarted = true;

            console.log("connected");

            startGame();
        }
    }
    if (response.responseType == 'gameStart') {
        cardDeck = JSON.parse(data.data);
    }

    if (response.responseType == 'userDisconnected') {
        alert("User disconnected, You win");
        redirectTo("game/play");
    }

    if (response.responseType == 'madeTurn') {
        console.log("Turn made");
        console.log(response.data);

        enemyCardDesk = JSON.parse(response.data).card;
        enemyCardDeckSlotDOM.insertAdjacentHTML("beforeend", createCardDOM(enemyCardDesk));
        enemyCardsHandDOM.removeChild(enemyCardsHandDOM.lastElementChild);

        my.hp -= enemyCardDesk.damage;

        updateDOMContent(myHpDOM, my.hp);

        myCardDesk = null;
        myCardDeckSlotDOM.innerHTML = "";

        if (my.hp < 0) {
            alert("YOU LOST");
        }

        console.log(my.hp);
        console.log(enemy.hp);

    }
}


function redirectTo(to) {
    window.location.href = `http://${window.location.hostname}:8080/${to}`;
}

function startGame() {
    waitingMsgDOM.remove();

    shuffleArray(cardDeck);

    for (let i = 0; i < 5; i++) {
        myCards.push(cardDeck.pop());
        enemyCards.push(cardDeck.pop());
    }


    myCards.forEach(element => {
        let cardDOM = createCardDOM(element);

        var div = document.createElement('div');
        div.innerHTML = cardDOM.trim();

        myCardsHandDOM.appendChild(div.firstChild);
    });


    let myCardsDOM = Array.from(document.getElementsByClassName("my-card"));
    let enemyCardsDOM = Array.from(document.getElementsByClassName("enemy-card"));

    for (let i = 0; i < myCardsDOM.length; i++) {
        myCardsDOM[i].addEventListener("click", () => {

            if (myCardDesk == null && isGameStarted) {
                myCardDesk = myCards[i];
                myCardDeckSlotDOM.innerHTML = myCardsDOM[i].outerHTML;
                myCardsDOM[i].remove();

                socket.send(JSON.stringify(
                    {
                        "requestType": "madeTurn",
                        "card": myCardDesk
                    }
                ));

                enemy.hp -= myCardDesk.damage;

                updateDOMContent(enemyHpDOM, enemy.hp);

                if (enemy.hp < 0) {
                    alert("YOU WIN");
                }

                enemyCards = null;
                enemyCardDeckSlotDOM.innerHTML = "";


                console.log(my.hp);
                console.log(enemy.hp);
            }

        })
    }

}


function createCardDOM(card) {
    return `
    <div class="card my-card">
        <img src="${card.imgUrl}" alt="">
        <div>
            <span>HP: ${card.hp}</span>
            <span>DAMAGE: ${card.damage}</span>
        </div>
    </div>
    `;
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
}

function updateDOMContent(node, newVal) {
    node.innerText = newVal;
}