$(document).ready(function(){
    
    var xmlHttp = createXmlHttpRequestObject();
    
    document.getElementById("searchSubmitButton").addEventListener("click", function() {
        queryFunction();
    });
    
    
    /*
     * Ova funkcionira samo so slika bidejki e direktno povrzana so imeto na slikata.
     * Mora mnogu kod da se prepravi ova da funkcionira i so imeto.
    **/ 
    $(document).on("click", ".bookBox img",  function(e) {
       var clicked = e.target.getAttribute("src").substr(13, 13); // go odvojuvame od slikata id-to
       console.log("clicked");
       window.location = 'bookPage.php?id=' + clicked;
    });
    
    $(document).on("click", "#signOut", function(e) {
        window.location = 'LogOut.php'; 
    });
    
    $(document).on("click", "#signIn", function(e) {
        window.location = 'mainSignInForm.php'; 
    });
    
    $(document).on("click", "#price", function e() {
        window.location = 'cart.php';
    });
    
    $(document).on("click", ".fancybox-close-small", function (e) {
        console.log("Hello, there");
    });
    
    $(document).on("change", '#selectQuantity', function () {
        var value = $(this).val();
        console.log(value);
        var isbn = this.parentElement.parentElement.getAttribute("id");
        alertify.alert('Confirm Title', 'Quantity changed to ' + value, function(){ 
            loadDoc("cart_header.php?new=" + isbn + "&qty=" + value, refreshCardHeader);
            window.location = "cart.php";
        }).set('closable', false);
    });
    
    $("#addButton").on("click", function(e) {
        var query = document.getElementById("isbn").innerHTML;
        loadDoc("cart_header.php?new=" + query, refreshCardHeader);
        alertify.alert("Book was added", "The book was added to your card").set('closable', false);
    });
    
    $(".removeBook").on("click", function(e) {
       var query = this.parentElement.parentElement.getAttribute("id");
       loadDoc("cart_header.php?new=" + query + "&qty=0", refreshCardHeader);
       window.location = 'cart.php';
    });
    
    function refreshCardHeader(xmlHttp) {
            var xmlDoc = xmlHttp.responseText.split(";");
            document.getElementById("price").innerHTML = "<img src='img/shopping-cart.png' id='cartLogo'>" + xmlDoc[0] + "\u20AC";
            document.getElementById("item").innerHTML = xmlDoc[1];    
    }
    
    
    $("#ulLeftNav li").on("click", function(e) {  
        var clicked = e.target.innerHTML;
        window.location = 'categoryRequest.php?cat=' + clicked;
    })
    
    function queryFunction() {
        var query = document.getElementsByName("searchRequest");
        var queryValue = query[0].value;
        window.location = "searchRequest.php?q=" + queryValue;
    }

    $("input[name=adresa]").on("click", function (e){
    	var value = $(this).attr('value');
        console.log(value);
    	loadDoc("chooseAddress.php?id=" + value, function (xmlHttp) {
            var xmlDoc = xmlHttp.responseText
            console.log("Ona sto vraka : " + xmlDoc);
        });
    })
    
    $(document).keypress(function(e) {
        if(e.which == 13) {
            queryFunction();
        }
    })
    
    function loadDoc(url, cFunction) {
        var xhttp;
        xhttp = createXmlHttpRequestObject();
        if(xhttp) {
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    cFunction(this);
                }
            }
        }
        xhttp.open("GET", url, false);
        xhttp.send();
    }
    
    
    function createXmlHttpRequestObject(){
        var xmlHttp;

        if(window.ActiveXObject){ 
            try{
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e){
                xmlHttp = false;
            }
        }else{ 
            try{
                xmlHttp = new XMLHttpRequest();
            }catch(e){
                xmlHttp = false;
            }
        }

        if(!xmlHttp)
            alert("Cant create that object !")
        else
            return xmlHttp;
        }
});