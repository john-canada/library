
(function () {
    'use strict';
    
    var module = {
        options: [],
        header: [navigator.platform, navigator.userAgent, navigator.appVersion, navigator.vendor, window.opera],
        dataos: [
            { name: 'Windows Phone', value: 'Windows Phone', version: 'OS' },
            { name: 'Windows', value: 'Win', version: 'NT' },
            { name: 'iPhone', value: 'iPhone', version: 'OS' },
            { name: 'iPad', value: 'iPad', version: 'OS' },
            { name: 'Kindle', value: 'Silk', version: 'Silk' },
            { name: 'Android', value: 'Android', version: 'Android' },
            { name: 'PlayBook', value: 'PlayBook', version: 'OS' },
            { name: 'BlackBerry', value: 'BlackBerry', version: '/' },
            { name: 'Macintosh', value: 'Mac', version: 'OS X' },
            { name: 'Linux', value: 'Linux', version: 'rv' },
            { name: 'Palm', value: 'Palm', version: 'PalmOS' }
        ],
        databrowser: [
            { name: 'Chrome', value: 'Chrome', version: 'Chrome' },
            { name: 'Firefox', value: 'Firefox', version: 'Firefox' },
            { name: 'Safari', value: 'Safari', version: 'Safari' },
            { name: 'Internet Explorer', value: 'MSIE', version: 'MSIE' },
            { name: 'Opera', value: 'Opera', version: 'Opera' },
            { name: 'BlackBerry', value: 'CLDC', version: 'CLDC' },
            { name: 'Mozilla', value: 'Mozilla', version: 'Mozilla' }
        ],
        init: function () {
            var agent = this.header.join(' '),
                os = this.matchItem(agent, this.dataos),
                browser = this.matchItem(agent, this.databrowser);
            
            return { os: os, browser: browser };
        },
        matchItem: function (string, data) {
            var i = 0,
                j = 0,
                html = '',
                regex,
                regexv,
                match,
                matches,
                version;
            
            for (i = 0; i < data.length; i += 1) {
                regex = new RegExp(data[i].value, 'i');
                match = regex.test(string);
                if (match) {
                    regexv = new RegExp(data[i].version + '[- /:;]([\\d._]+)', 'i');
                    matches = string.match(regexv);
                    version = '';
                    if (matches) { if (matches[1]) { matches = matches[1]; } }
                    if (matches) {
                        matches = matches.split(/[._]+/);
                        for (j = 0; j < matches.length; j += 1) {
                            if (j === 0) {
                                version += matches[j] + '.';
                            } else {
                                version += matches[j];
                            }
                        }
                    } else {
                        version = '0';
                    }
                    return {
                        name: data[i].name,
                        version: parseFloat(version)
                    };
                }
            }
            return { name: 'unknown', version: 0 };
        }
    };
  var e = module.init(),
        debug = '';
    
    debug += 'os.name = ' + e.os.name + '<br/>';
    debug += 'os.version = ' + e.os.version + '<br/>';
    debug += 'browser.name = ' + e.browser.name + '<br/>';
    debug += 'browser.version = ' + e.browser.version + '<br/>';
    
    debug += '<br/>';
    debug += 'navigator.userAgent = ' + navigator.userAgent + '<br/>';
    debug += 'navigator.appVersion = ' + navigator.appVersion + '<br/>';
    debug += 'navigator.platform = ' + navigator.platform + '<br/>';
    debug += 'navigator.vendor = ' + navigator.vendor + '<br/>';

if((e.browser.name)=="Safari"){
   if ((document.documentElement.clientWidth >=768) && (document.documentElement.clientWidth <=1024)) {
if((e.os.name)=="iPad"){

           if(((e.os.version)=="7.11") ||
            ((e.os.version)=="8.4") || 
            ((e.os.version)=="8.1") ||
            ((e.os.version)=="8.11")||
            ((e.os.version)=="8.12")||
            ((e.os.version)=="7.1")||
            ((e.os.version)=="8.3")||
            ((e.os.version)=="7")  ||
            ((e.os.version)=="6")  ||
            ((e.os.version)=="5.1")||
            ((e.os.version)=="5")  ||
            ((e.os.version)=="7.12")||
            ((e.os.version)=="7.04")) {
    
                    if(window.innerHeight < window.innerWidth){
                                $('.products.columns-3').css('width','100%');
                                $('.woocommerce-ordering-filter').css('width','100%');
                        }else{
                                $('.products.columns-3').css('width','156%');
                                $('.woocommerce-ordering-filter').css('width','150%');
                        }
                

                    }else{
             
                                $('.products.columns-3').css('width','100%');
                                $('.woocommerce-ordering-filter').css('width','100%');
                        }
                    }

          $(window).on('orientationchange', function(event) {
            if(((e.os.version)=="7.11") ||
            ((e.os.version)=="8.4") || 
            ((e.os.version)=="8.1") ||
            ((e.os.version)=="8.11")||
            ((e.os.version)=="8.12")||
            ((e.os.version)=="7.1")||
            ((e.os.version)=="8.3")||
            ((e.os.version)=="7")  ||
            ((e.os.version)=="6")  ||
            ((e.os.version)=="5.1")||
            ((e.os.version)=="5")  ||
            ((e.os.version)=="7.12")||
            ((e.os.version)=="7.04")) {

                if(window.innerHeight < window.innerWidth){
                    $('.products.columns-3').css('width','100%');
                    $('.woocommerce-ordering-filter').css('width','100%');
            }else{
                    $('.products.columns-3').css('width','156%');
                    $('.woocommerce-ordering-filter').css('width','150%');
            }

            }else{
                $('.products.columns-3').css('width','100%');
                $('.woocommerce-ordering-filter').css('width','100%');
            }

            if((e.os.version)=="5"){
                if(window.innerHeight < window.innerWidth){
                    $('.products.columns-3').css('width','100%');
                    $('.woocommerce-ordering-filter').css('width','100%');
            }else{
                    $('.products.columns-3').css('width','156%');
                    $('.woocommerce-ordering-filter').css('width','150%');
            }
            }

            });

       }

    }

}());
