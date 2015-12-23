/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getPayqrCartData()
{
    PayqrAjaxLoad('/payqr/module/index.php?path=ajaxbutton&type=cart', function(xhr) {
        var response = JSON.parse(xhr.response);
        var btn = document.getElementsByClassName("payqr-button")[0];
        btn.setAttribute("data-amount", response.amount);
        btn.setAttribute("data-cart", JSON.stringify(response.datacart));
    });
}


 
function PayqrAjaxLoad(url, callback) 
{
    var xhr;

    if(typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
    else {
        var versions = ["MSXML2.XmlHttp.5.0", 
                        "MSXML2.XmlHttp.4.0",
                        "MSXML2.XmlHttp.3.0", 
                        "MSXML2.XmlHttp.2.0",
                        "Microsoft.XmlHttp"]

         for(var i = 0, len = versions.length; i < len; i++) {
            try {
                xhr = new ActiveXObject(versions[i]);
                break;
            }
            catch(e){}
         } // end for
    }

    xhr.onreadystatechange = ensureReadiness;

    function ensureReadiness() {
        if(xhr.readyState < 4) {
            return;
        }

        if(xhr.status !== 200) {
            return;
        }

        // all is well  
        if(xhr.readyState === 4) {
            callback(xhr);
        }           
    }

    xhr.open('GET', url, true);
    xhr.send('');
}