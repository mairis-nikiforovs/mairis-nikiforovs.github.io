<head>
  <link rel="stylesheet" href="style.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js' type='text/javascript'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body data-new-gr-c-s-check-loaded="14.1115.0" data-gr-ext-installed="">

<div id="wrapper">
  <div id="player1" class="player" height="200px" width="400px;">
    <h1>Team 1 </h1>
    <div class="container">
      <p class="punktiText">Punkti:</p>
      <p class="points">0</p>
    </div>
    <div class="container">
      <p class="cenaText">Minējums</p>
      <p class="cena">0</p>
    </div>
    <div class="container">
      <p class="starpibaText">Starpība</p>
      <p class="starpiba">0</p>
    </div>
  </div>

  <div id="player2" class="player" height="200px" width="400px;">
    <h1>Team 2 </h1>
    <div class="container">
      <p class="punktiText">Punkti:</p>
      <p class="points">0</p>
    </div>
    <div class="container">
      <p class="cenaText">Minējums</p>
      <p class="cena">0</p>
    </div>
    <div class="container">
      <p class="starpibaText">Starpība</p>
      <p class="starpiba">0</p>
    </div>
  </div>

  <div id="player3" class="player" height="200px" width="400px;">
    <h1>Team 3 </h1>
    <div class="container">
      <p class="punktiText">Punkti:</p>
      <p class="points">0</p>
    </div>
    <div class="container">
      <p class="cenaText">Minējums</p>
      <p class="cena">0</p>
    </div>
    <div class="container">
      <p class="starpibaText">Starpība</p>
      <p class="starpiba">0</p>
    </div>
  </div>

  <div id="produkts" class="product" height="200px" width="400px;">
    <h1>Produkts </h1>
    <p class="apraksts">0</p>
    <p class="cena">0</p>
  </div>
</div>


<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
  import { getDatabase, ref, onValue, get }  from "https://www.gstatic.com/firebasejs/10.7.0/firebase-database.js";
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

  onValue(uzminicenu, (snapshot) => {
      const player1 = snapshot.val().team1;
      const player2 = snapshot.val().team2;
      const player3 = snapshot.val().team3;
      const produkts = snapshot.val().produkts;
      //player1
      $('#player1 .points').text(player1.punkti);
      $('#player1 .cena').text(player1.cena);


      //player2
      $('#player2 .points').text(player2.punkti);
      $('#player2 .cena').text(player2.cena);


      //player3
      $('#player3 .points').text(player3.punkti);
      $('#player3 .cena').text(player3.cena);

      //produkts
      $('#produkts .apraksts').text(produkts.apraksts);
      if(produkts.cena === 0){
        $('#produkts .cena').text("???");
      }else{
        $('#produkts .cena').text(produkts.cena);
      }
  
      get(uzminicenu).then((snapshot) => {
        if (snapshot.exists()) {
          var produktaCena = snapshot.val().produkts.cena;
          var player1Starpiba = Math.abs(produktaCena-player1.cena).toFixed(2);
          var player2Starpiba = Math.abs(produktaCena-player2.cena).toFixed(2);
          var player3Starpiba = Math.abs(produktaCena-player3.cena).toFixed(2);
          if(produktaCena === 0){
            $('#player1 .starpiba').text("-");
            $('#player2 .starpiba').text("-");
            $('#player3 .starpiba').text("-");
          }else{
            $('#player1 .starpiba').text(player1Starpiba);
            $('#player2 .starpiba').text(player2Starpiba);
            $('#player3 .starpiba').text(player3Starpiba);
          }
        } else {
          console.log("No data available");
        }
      }).catch((error) => {
        console.error(error);
      });

      
    });

</script>
  
</body>