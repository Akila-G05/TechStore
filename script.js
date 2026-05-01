var loader = document.getElementById("cssLoader17");

window.addEventListener("load", function(){
     loader.style.display = "none"
})

function changeView(){

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signup(){

    var fn = document.getElementById("fn");
    var l = document.getElementById("ln");
    var e = document.getElementById("e");
    var p = document.getElementById("pw");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var f = new FormData();
    f.append("f",fn.value);
    f.append("l",l.value);
    f.append("e",e.value);
    f.append("p",p.value);
    f.append("m",m.value);
    f.append("g",g.value);

    var r =  new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var  t = r.responseText;
            
            if(t == "Success"){
                document.getElementById("msg").innerHTML=t;
                document.getElementById("msg").className="bi bi-check-circle-fill fs-5";
                document.getElementById("alertdiv").className="alert alert-success";
                document.getElementById("msgdiv").className="d-block";
            }else{
                document.getElementById("msg").innerHTML=t;
                document.getElementById("msgdiv").className="d-block";
            }

        }
    }

    r.open("POST","signupProcess.php",true);
    r.send(f);

}

function signIn(){
    
    var email = document.getElementById("email2");
    var password = document.getElementById("p2");
    var rememberme = document.getElementById("r");

    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("e",email.value);
    f.append("p",password.value);
    f.append("r",rememberme.checked);

    r.onreadystatechange = function(){
        if(r.readyState == 4){
           var t = r.responseText;

            if(t == "Success"){
                window.location = "home.php";
            }else{
                document.getElementById("msg2").innerHTML=t;
                document.getElementById("msgdiv2").className="d-block";
            }
   
        }
    };

    r.open("POST","signinProcess.php",true);
    r.send(f);

}

var fm;
function forgotPw(){
    
    var email = document.getElementById("email2").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            }else{
                document.getElementById("msg2").innerHTML=t;
                document.getElementById("msgdiv2").className="d-block";;
            }
        }
    }

    r.open("GET","forgotPasswordProcess.php?e="+email,true);
    r.send();

}

function ShowPassword(){

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if(i.type=="password"){
        i.type="text";
        eye.className = "bi bi-eye-fill";
    }else{
        i.type="password";
        eye.className ="bi bi-eye-slash-fill";
    }

}

function ShowPassword2(){
    
    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if(i.type=="password"){
        i.type="text";
        eye.className = "bi bi-eye-fill";
    }else{
        i.type="password";
        eye.className ="bi bi-eye-slash-fill";
    }

}

function resetpw(){

    var email = document.getElementById("email2");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e",email.value);
    f.append("n",np.value);
    f.append("r",rnp.value);
    f.append("v",vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "success"){

                bm.hide();
                alert("Password reset Success");

            }else{
                alert(t);
            }
        }
    }

    r.open("POST","resetPasswordProcess.php",true);
    r.send(f);

} 

function signout(){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }
        }
    }

    r.open("GET","signoutProcess.php",true);
    r.send();

}

function changeStatus(id){
    
    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t == "deactivated"){

                alert("Product Deactivated");
                window.location.reload();

            }else if(t == "activated"){

                alert("Product Activated");
                window.location.reload();

            }else{
                alert(t);
            }
        
        }
    }

    r.open("GET","changeStatus.php?p="+product_id, true);
    r.send();
    
}

function search_myproduct(x){

    var select = document.getElementById("mp_search_select");
    var text = document.getElementById("mp_search_txt");

    var f = new FormData();
    f.append("s",select.value);
    f.append("t",text.value);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            // alert(t);
            document.getElementById("search").innerHTML = t;

        }
    }

    r.open("POST","myProductSearchProcess.php",true);
    r.send(f);
    
}

var mpm;
function deleteFromMyProduct(id){

    var m = document.getElementById("deleteMyProductModal" + id);
    mpm = new bootstrap.Toast(m);
    mpm.show();

}


function deleteFromMyProduct2(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                alert("Product removed.")
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","deleteFromMyProductProcess.php?id="+id,true);
    r.send();

}

function changeUploadImage(){
    
    var image = document.getElementById("imageUploader");

    image.onchange = function (){

        var file_count = image.files.length;

        if(file_count <= 3){
            
            for(var x = 0; x < file_count; x++){
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        }else{
            alert("Please insert image");
        }

    }
    
}

function addProduct(){
    
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;
    if(document.getElementById("b").checked){
        condition = 1;
    }else if(document.getElementById("u").checked){
        condition = 2;
    }

    var colour = document.getElementById("clr");
    var colour_input = document.getElementById("clr_in");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageUploader");
    var discount = document.getElementById("dis");

    var f = new FormData();
    f.append("ca",category.value);
    f.append("b",brand.value);
    f.append("m",model.value);
    f.append("t",title.value);
    f.append("con",condition);
    f.append("clr",colour.value);
    f.append("clr_in",colour_input.value);
    f.append("qty",qty.value);
    f.append("cost",cost.value);
    f.append("dwc",dwc.value);
    f.append("doc",doc.value);
    f.append("desc",desc.value);
    f.append("dis",discount.value);


    var file_count = image.files.length;

    for(var x = 0; x < file_count; x++){
        f.append("image" + x,image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t == "Product Saved Successfully"){
                window.location.reload();
                alert("Product Saved Successfully")
            }else{
                alert(t);
            }

        }
    }

    r.open("POST","addProductProcess.php",true);
    r.send(f);

}

function load_brand(){
    
    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;

        }
    }

    r.open("GET","loadBrand.php?c="+category,true);
    r.send();
    
}

function load_model(){

    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            document.getElementById("model").innerHTML = t;

        }
    }

    r.open("GET","loadModel.php?b="+brand,true);
    r.send();
  
}

function sendId(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){

        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location = "updateProduct.php";
            }else{
                alert(t);
            }
            
        }

    }

    r.open("POST","sendProductIdProcess.php?id="+id,true);
    r.send();

}

function updateProduct(){

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("desc");
    var images = document.getElementById("imageUploader");
    var discount = document.getElementById("discount");

    var f = new FormData();
    f.append("t",title.value);
    f.append("q",qty.value);
    f.append("c",cost.value);
    f.append("dwc",dwc.value);
    f.append("doc",doc.value);
    f.append("d",description.value);
    f.append("dis",discount.value);

    var img_count =  images.files.length;

    for(var x = 0; x < img_count; x++){
        f.append("i" + x,images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;  
            alert(t);
        }
    }

    r.open("POST","updateProcess.php",true);
    r.send(f);
    
}

function profileSetting(){

    var profile = document.getElementById("profile");
    var desc = document.getElementById("profile_desc");

    profile.classList.toggle("d-none");
    desc.classList.toggle("d-none");

}

function changeImage(){

    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function(){
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }

}

function updateProfile(){

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");
    var desc = document.getElementById("desc");


    var f = new FormData();

    f.append("fn",fname.value);
    f.append("ln",lname.value);
    f.append("m",mobile.value);
    f.append("l1",line1.value);
    f.append("l2",line2.value);
    f.append("p",province.value);
    f.append("d",district.value);
    f.append("c",city.value);
    f.append("pc",pcode.value);
    f.append("desc",desc.value);

    if(image.files.length == 1){

        confirm("Are you sure? You don't want to update Profile Image."); 

        f.append("image",image.files[0]);

    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","updateProfileProcess.php",true);
    r.send(f);

}

function loadMainImg(id){

    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");

    main.src = (img);

}

function payNow(id){

    var m = document.getElementById("buyNowModal" + id);
    var pnm = new bootstrap.Modal(m);

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            var obj = JSON.parse(t); 

            var mail = obj["mail"];
            var amount = obj["amount"];
            var result = obj["result"];
            var orderId = obj["Oid"];
            var id = obj["pid"];
            var qty = obj["qty"];
            
            if(t == "1"){
                alert("Please Login or Signup");
                window.location = "index.php";
            }else if(t == "2"){
                alert("Please update your profile Frist");
                window.location = "userProfile.php";
            }else{

                pnm.show();

                DirectPayCardPayment.init({
                    container: 'result', //<div id="card_container"></div>
                    merchantId: 'IJ15268', //your merchant_id
                    amount: obj["amount"],
                    refCode: "DP12345", //unique referance code form merchant
                    currency: 'LKR',
                    type: 'ONE_TIME_PAYMENT',
                    customerEmail: mail,
                    customerMobile: '+94712584756',
                    description: 'test products',  //product or service description
                    debug: true,
                    responseCallback: responseCallback,
                    errorCallback: errorCallback,
                    logo: 'https://test.com/directpay_logo.png',
                    apiKey: '22275f26ea526b7c1cce4ba4b95abd4cd9590da991c2cf905adb4015a75e5ea3'
                });
            
                //response callback.
                function responseCallback(result) {
                    console.log("successCallback-Client", result);
                    // alert(JSON.stringify(result));
                    saveInvoice(orderId,id,mail,amount,qty);
                    
                }
            
                //error callback
                function errorCallback(orderId) {
                    console.log("successCallback-Client", orderId);
                }   
            }

        }
    }

    r.open("GET","buyNowProcess.php?id="+id+"&qty="+qty,true);
    r.send();

}

function checkout(x){

    var m = document.getElementById("checkoutModal");
    var pnm = new bootstrap.Modal(m);
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            var obj = JSON.parse(t); 

            var mail = obj["mail"];
            var subTotal = obj["subTotal"];
            var result1 = obj["result"];
            var o_id = obj["o_id"];
            
            if(t == "1"){
                alert("Please Login or Signup");
                window.location = "index.php";
            }else{
                pnm.show();

                DirectPayCardPayment.init({
                    container: 'result', //<div id="card_container"></div>
                    merchantId: 'IJ15268', //your merchant_id
                    amount: subTotal,
                    refCode: "DP12345", //unique referance code form merchant
                    currency: 'LKR',
                    type: 'ONE_TIME_PAYMENT',
                    customerEmail: mail,
                    customerMobile: '+94712584756',
                    description: 'test products',  //product or service description
                    debug: true,
                    responseCallback: responseCallback,
                    errorCallback: errorCallback,
                    logo: 'https://test.com/directpay_logo.png',
                    apiKey: '22275f26ea526b7c1cce4ba4b95abd4cd9590da991c2cf905adb4015a75e5ea3'
                });
            
                //response callback.
                function responseCallback(result1) {
                    console.log("successCallback-Client", result1);
                    // alert(JSON.stringify(result));
                    saveInvoiceCart(o_id);
                    
                }
            
                //error callback
                function errorCallback(result1) {
                    console.log("successCallback-Client", result1);
                }   
            }
        }
    }

    r.open("GET","checkoutProcess.php?total="+x,true);
    r.send();

}

function saveInvoiceCart(o_id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t == "Success"){
                window.location = "invoice.php?id=" + o_id;
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","saveInvoiceCart.php?Oid="+o_id,true);
    r.send();

}

function saveInvoice(orderId,id,mail,amount,qty){

    var f = new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",mail);
    f.append("a",amount);
    f.append("q",qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                window.location = "invoice.php?id=" + orderId;
            }else{
                alert (t);
            }
        }
    }

    r.open("POST","Saveinvoice.php",true);
    r.send(f);

}

function printInvoice(){

    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;

}

function savePDF(){

    var element = document.getElementById('page');
    html2pdf(element);


}

function addToCart(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET","addToWatchlistPocess.php?id="+id,true);
    r.send();

}

function deleteFromCart(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
            
        }
    }

    r.open("GET","deleteFromCartProcess.php?id="+id,true);
    r.send();

}

function addToWatchlist(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t == "Removed"){
                document.getElementById("heart"+id).style.className = "text-secondary";
                window.location.reload();
            }else if(t == "added"){
                document.getElementById("heart"+id).style.className = "text-danger";
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","addToWatchlistProcess.php?id="+id,true);
    r.send();

}

function search_watchlist(id){

    var search_txt = document.getElementById("watchlist_txt");
    var search_select = document.getElementById("watchlist_select");

    var f = new FormData()
    f.append("txt",search_txt.value);
    f.append("select",search_select.value);
    f.append("id",id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("result").innerHTML = t;
         
        }
    }

    r.open("POST","watchlistSearchProcess.php",true);
    r.send(f);

}

function RemoveFromWatchlist(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
        }

    } 

    r.open("GET","removeWatchlistProcess.php?id="+id,true);
    r.send();

}

function advancedSearch(x){
    var txt = document.getElementById("text");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var condition = document.getElementById("condition");
    var color = document.getElementById("colour");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("sort");



    var f = new FormData();
    f.append("t",txt.value);
    f.append("cat",category.value);
    f.append("b",brand.value);
    f.append("m",model.value);
    f.append("con",condition.value);
    f.append("col",color.value);
    f.append("pf",from.value);
    f.append("to",to.value);
    f.append("s",sort.value);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("result").innerHTML = t;
        }
    }

    r.open("POST","advancedSearchProcess.php",true);
    r.send(f);

}

function basicSearch(x){

    var txt = document.getElementById("txt");
    var select = document.getElementById("select");

    var f =new FormData();
    f.append("t",txt.value);
    f.append("s",select.value);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("result").innerHTML = t;
        }
    }

    r.open("POST","basicSearchProcess.php",true);
    r.send(f);
    
}

function viewMsg(email){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("chat").innerHTML = t;
        }
    }
    
    r.open("GET","viewMsgProcess.php?e="+email,true);
    r.send();

}

function send_msg(){

    var email = document.getElementById("rmail");
    var msg = document.getElementById("msg_txt");

    var f = new FormData();
    f.append("e",email.innerHTML);
    f.append("msg",msg.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","sendMsgProcess.php",true);
    r.send(f);

}

// function keycheck(event){

//     var keycode = event.which;
//     var txt = document.getElementById["search"].value;

//     if(keycode == 13){

//         var r = new XMLHttpRequest();

//         r.onreadystatechange = function () { 
//             if(r.readyState == 4){
//                 var t = r.responseText;
//                 alert(t);
//             }
//         }
        
//         r.open("GET","searchMsgProcess.php?t="+txt,true);
//         r.send();

//     }
    
// }

function deleteFromHistory(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
            
        }
    }
    
    r.open("GET","deleteFromHistoryProcess.php?id="+id,true);
    r.send();

}

function deleteAllFromHistory(){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                alert("All Clear");
                window.location.reload();
            }else{
                alert(t);
            }
            
        }
    }
    
    r.open("GET","deleteAllHistoryProcess.php",true);
    r.send();

}

var fd;
function addFeddback(id){

    var m = document.getElementById("feedbackModal" + id);
    var fd = new bootstrap.Modal(m);
    fd.show();

}

function sendFeedback(id){

    var status;
    if(document.getElementById("type1" + id).checked){
        status = 1;
    }else if(document.getElementById("type2" + id).checked){
        status = 2;
    }else if(document.getElementById("type3" + id).checked){
        status = 3;
    }else if(document.getElementById("type4" + id).checked){
        status = 4;
    }else if(document.getElementById("type5" + id).checked){
        status = 5;
    }

    var text = document.getElementById("text" + id);

    var f = new FormData()
    f.append("id",id);
    f.append("t",text.value);
    f.append("s",status);
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "1"){
                alert("Success");
                window.location.reload();
            }else{
                alert(t);
            }   
        }
    }

    r.open("POST","sendFeedbackProcess.php",true);
    r.send(f);

}

var vm;
function sendVerificationCode(){

    var m = document.getElementById("verificationModal");
    var vm = new bootstrap.Modal(m);

    var email = document.getElementById("email").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                vm.show();
            }else{
                alert(t);
            }
            
        }
    }

    r.open("GET","sendVerifivationCodeProcess.php?e="+email,true);
    r.send();

}

function verify(){

    var vcode = document.getElementById("vcode").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            if(t == "Success"){
                window.location = "adminPannel.php";
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","adminVerificationProcess.php?v="+vcode,true);
    r.send();

}

function productDetails(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r. responseText;
            document.getElementById("result").innerHTML = t;
        }
    }

    r.open("GET","showProductDetails.php?id="+id,true);
    r.send();

}

function blockProduct(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if (t == "blocked") {
                document.getElementById("pb" + id).innerHTML = "Unblock";
                document.getElementById("pb" + id).classList = "btn btn-success rounded-5";
            } else if (t == "unblocked") {
                document.getElementById("pb" + id).innerHTML = "Block";
                document.getElementById("pb" + id).classList = "btn btn-danger rounded-5";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET","blockProductProcess.php?id="+id,true);
    r.send();

}

function aroduct(x){

    var text = document.getElementById("text").value;

    var f = new FormData();
    f.append("text",text);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("result2").innerHTML = t;
        }
    }

    r.open("POST","adminSearchProduct.php",true);
    r.send(f);

}

// category
var cm;
function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

function saveCategory() {

    var txt = document.getElementById("txt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET","SaveCategoryProcess.php?txt="+txt,true);
    r.send();

}

var dcm;
function deleteCateogryModal(id){

    var dm = document.getElementById("deleteCategoryModal" + id);
    dcm = new bootstrap.Modal(dm);
    dcm.show();
    
}

function deleteCategory(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","deleteCategoryProcess.php?id="+id,true);
    r.send();

}

var rcm;
function renameCategoryModal(id){

    var rm = document.getElementById("renameCategoryModal" + id);
    rcm = new bootstrap.Modal(rm);
    dcm.hide();
    rcm.show();

}

function renameCategory(id){

    var name = document.getElementById("n").value;

    var f = new FormData();
    f.append("name",name);
    f.append("id",id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("POST","renameCategoryProcess.php",true);
    r.send(f);

}
// category

// brand
var bm;
function addNewBrand() {
    var m = document.getElementById("addBrandModal");
    bm = new bootstrap.Modal(m);
    bm.show();
}

function saveBrand(){

    var c = document.getElementById("category").value;
    var b = document.getElementById("bname").value;

    var f = new FormData();
    f.append("category",c);
    f.append("bname",b);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
           
        }
    }

    r.open("POST","saveBrandProcess.php",true);
    r.send(f);

}

var dbm;
function deleteBrandModal(id){

    var dm = document.getElementById("deletebrandModal" + id);
    dbm = new bootstrap.Modal(dm);
    dbm.show();

}

function deleteBrand(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","deleteBrandProcess.php?id="+id,true);
    r.send();

}

var rbm;
function renameBrandModal(id){

    var rm = document.getElementById("renameBrandModal" + id);
    rbm = new bootstrap.Modal(rm);
    dbm.hide();
    rbm.show();

}

function renameBrand(id){

    var name = document.getElementById("bname2").value;

    var f = new FormData();
    f.append("bname",name);
    f.append("id",id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("POST","renameBrandProcess.php",true);
    r.send(f);

}
// brand

// model
var mm;
function addNewModel() {
    var m = document.getElementById("addModel");
    mm = new bootstrap.Modal(m);
    mm.show();
}

function load_brand_admin() {

    var category = document.getElementById("category1").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "loadBrandinAdmin.php?c=" + category, true);
    r.send();

}

function saveModel(){

    var b = document.getElementById("brand").value;
    var m = document.getElementById("mname").value;

    var f = new FormData();
    f.append("brand",b);
    f.append("mname",m);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }
           
        }
    }

    r.open("POST","saveModelProcess.php",true);
    r.send(f);

}

var dmm;
function deleteModelModal(id){

    var dm = document.getElementById("deleteModel" + id);
    dmm = new bootstrap.Modal(dm);
    dmm.show();

}

function deleteModel(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "Success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("GET","deleteModelProcess.php?id="+id,true);
    r.send();

}

var rmm;
function renameModelModal(id){

    var rm = document.getElementById("renameModelModal" + id);
    rmm = new bootstrap.Modal(rm);
    dmm.hide();
    rmm.show();

}

function renameModel(id){

    var name = document.getElementById("mname2").value;

    var f = new FormData();
    f.append("mname",name);
    f.append("id",id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(t == "success"){
                window.location.reload();
            }else{
                alert(t);
            }

        }
    }

    r.open("POST","renameModelProcess.php",true);
    r.send(f);

}
// model

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if (t == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success rounded rounded-5";
            } else if (t == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger rounded rounded-5";
            } else {
                alert(t);
            }
        
        }
    }

    r.open("GET","userBlockProcess.php?email="+email,true);
    r.send();
}

function findusers(x){

    var txt = document.getElementById("text").value;

    var f = new FormData();
    f.append("txt",txt);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            document.getElementById("result").innerHTML = t;
            
        }
    }

    r.open("POST","findUsersProcess.php",true);
    r.send(f);

}

function changeProductStatus(id){

    var status = document.getElementById("s");

    var f = new FormData();
    f.append("s",status.value);
    f.append("id",id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = this.responseText;
            alert(t);

        }
    }

    r.open("POST","changeinvoiceStatus.php",true);
    r.send(f);

}

function trackPackage(){

    var text = document.getElementById("search").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = this.responseText;
            
            if(t == "1"){
                alert("Please Enter Your Order ID");
            }else if(t == "2"){
                alert("Invalid Order ID");
            }else{
                document.getElementById("result").innerHTML = t;
            }

        }
    }

    r.open("GET","trackPackageProcess.php?text="+text,true);
    r.send();

}