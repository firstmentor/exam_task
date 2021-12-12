 
<style>
  body {
    font-family: "Lato", sans-serif;
  }

  .sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color:#8080800a; 
    padding-top: 20px;
    box-shadow: 2px 0px 3px 2px #e4e2e2; 
  }

  .sidenav a {
    padding: 6px 8px 6px 50px;
    text-decoration: none;
    font-size: 20px;
    color: black;
    display: block;
  } 
  .main {
    margin-left: 160px; /* Same as the width of the sidenav */
    font-size: 28px; /* Increased text to enable scrolling */
    padding: 0px 10px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  </style>
</head>
<body>

  <div class="sidenav">
    <a href="{{url('/view-category')}}">View Categories</a>
    <a href="{{url('/view-exam')}}">View Question</a> 
  </div>  

