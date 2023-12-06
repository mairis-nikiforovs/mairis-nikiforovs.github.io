<head>
  <link rel="stylesheet" href="style.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js' type='text/javascript'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body data-new-gr-c-s-check-loaded="14.1115.0" data-gr-ext-installed="">

<div id="wrapper2">
  <button id="resetPlayers">Reset Playeru Summas</button>
  <button id="resetProduct">Reset Produkta Summu</button>
  <div class="container">
    <button id="setTeam1Guess">SET TEAM 1 GUESS</button>
    <input id="team1Guess" type="number"/>
  </div>
  <div class="container">
    <button id="setTeam2Guess">SET TEAM 2 GUESS</button>
    <input id="team2Guess" type="number"/>
  </div>
  <div class="container">
    <button id="setTeam3Guess">SET TEAM 3 GUESS</button>
    <input id="team3Guess" type="number"/>
  </div>
  <div class="container">
    <button id="setProductPrice">SET PRODUCT PRICE</button>
    <input id="productPrice" type="number"/>
  </div>
  <div class="container">
    <button id="setProductName">SET PRODUCT NAME</button>
    <input id="productName" type="text"/>
  </div>
  
</div>


<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
  import { getDatabase, ref, onValue, get, set }  from "https://www.gstatic.com/firebasejs/10.7.0/firebase-database.js";
  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyAAoCC_sfhL8-FAXlzrGspFTFscF2QPfD0",
    authDomain: "charity-d9975.firebaseapp.com",
    databaseURL: "https://charity-d9975-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "charity-d9975",
    storageBucket: "charity-d9975.appspot.com",
    messagingSenderId: "849116577372",
    appId: "1:849116577372:web:2df42d50e78bb863c37099"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

  const db = getDatabase(app);

  const uzminicenu = ref(db, 'root/uzminicenu');
  const team1 = ref(db, 'root/uzminicenu/team1');
  const team2 = ref(db, 'root/uzminicenu/team2');
  const team3 = ref(db, 'root/uzminicenu/team3');
  const produkts = ref(db, 'root/uzminicenu/produkts');


  $('#resetPlayers').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var produkts = snapshot.val().produkts;
          var player1 = snapshot.val().team1;
          var player2 = snapshot.val().team2;
          var player3 = snapshot.val().team3;
          set(ref(db, 'root/uzminicenu/team1'), {
            cena: 0,
            punkti: player1.punkti
          });
          set(ref(db, 'root/uzminicenu/team2'), {
            cena: 0,
            punkti: player2.punkti
          });
          set(ref(db, 'root/uzminicenu/team3'), {
            cena: 0,
            punkti: player3.punkti
          });
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#resetProduct').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var produkts = snapshot.val().produkts;
          set(ref(db, 'root/uzminicenu/produkts'), {
            cena: 0,
            apraksts: produkts.apraksts
          });
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#setTeam1Guess').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var player1 = snapshot.val().team1;
          var value = $( "#team1Guess" ).val();
          if(value === ""){
            value = 0;
          }
          set(ref(db, 'root/uzminicenu/team1'), {
            cena: Number(value),
            punkti: player1.punkti
          });
          $( "#team1Guess" ).val("");
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#setTeam2Guess').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var player2 = snapshot.val().team2;
          var value = $( "#team2Guess" ).val();
          if(value === ""){
            value = 0;
          }
          set(ref(db, 'root/uzminicenu/team2'), {
            cena: Number(value),
            punkti: player2.punkti
          });
          $( "#team2Guess" ).val("");
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#setTeam3Guess').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var player3 = snapshot.val().team3;
          var value = $( "#team3Guess" ).val();
          if(value === ""){
            value = 0;
          }
          set(ref(db, 'root/uzminicenu/team3'), {
            cena: Number(value),
            punkti: player3.punkti
          });
          $( "#team3Guess" ).val("");
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#setProductPrice').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var product = snapshot.val().produkts;
          var value = $( "#productPrice" ).val();
          if(value === ""){
            value = 0;
          }
          set(ref(db, 'root/uzminicenu/produkts'), {
            cena: Number(value),
            apraksts: product.apraksts
          });
          $( "#productPrice" ).val("");
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

  $('#setProductName').on('click', function(){
    get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var product = snapshot.val().produkts;
          var value = $( "#productName" ).val();
          set(ref(db, 'root/uzminicenu/produkts'), {
            cena: product.cena,
            apraksts: value
          });
          $( "#productName" ).val("");
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });
  });

</script>
  
</body>