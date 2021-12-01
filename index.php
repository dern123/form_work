<?php

    session_start();

    $config = file_get_contents(dirname(__FILE__) . '/config/config.json'); 
    $dataConfig = json_decode($config, true); 

    require_once dirname(__FILE__) . '/config/php/block.php';           // Блок от некоторых случайных выкачиваний сайта
    require_once dirname(__FILE__) . '/config/php/function.php';        // Подключение функций
    // require_once dirname(__FILE__) . '/config/page/main.php';           // Приоритетный набор различного функционала для работы сайта

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Газпром</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Ubuntu:400,500,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="css/fonts.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/inputmask/inputmask.min.js"></script>
    <?php require_once dirname(__FILE__) . '/config/page/head.php';                     // Добавление и отображение дополнительных скриптов     ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <link href="assets/landing/css/intlTelInput.css" rel="stylesheet" type="text/css">
    <link href="assets/landing/css/landing.css" rel="stylesheet" type="text/css">
    <style>
        .success_block h3 {
            color: #2c2655!important;
        }
    </style>
</head>

<body class="text-primary font-sans leading-snug">

<header class="sm:w-full sm:z-50 sm:mb-8">
    <div class="container relative flex justify-between items-center mx-auto py-4 mb-6 sm:mb-0">

    </div>
</header>



<main class="">


    <section id="about" class="container mx-auto mb-24 sm:mb-24">
        <div class="w-full flex justify-center items-center sm:flex-col">

            <!-- <div class="relative pr-2 w-2/3 flex sm:pr-0 sm:w-full sm:mr-0 js-vid1 sm:mb-12">
                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; width: 100%; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
                <div class='embed-container'>
                    <iframe src="https://player.vimeo.com/video/559848413?autoplay=1&loop=1&autopause=0&muted=1" frameborder="0"  allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                </div>
            </div> -->
            <div class="pl-6 block w-1/3 sm:p-0 sm:w-full">
                <div class="waiting_block"><img class="icon-form hrest" src="./assets/landing/img/hrest.webp" alt="hrest" ></div>
                <div class="success_block">
                    <h3>Ваша заявка успешно оставлена!</h3>
                    <img src="assets/landing/img/success.png">
                </div>
                
                <form class="block bg-white sm:shadow-none sm:bg-transparent rounded-custom shadow-form text-primary overflow-hidden w-full pt-6 pb-4 px-6 sm:pt-2 sm:px-4 sm:leading-tight">
                    <h3 class="text-2xl text-center font-bold font-ubuntu mb-6 sm:mb-10">ОСТАВЬТЕ ЗАЯВКУ</h3>
                    <!-- <a id = "landurl" href = "">URL!!!!!!!!!!!!!!</a> -->
                    <div class="flex flex-col mb-8 sm:mb-10">
                        <input class="inputForm pl-0 p-2 border-b border-primary sm:bg-transparent focus:outline-none" id="top_name" type="text" name="forename" placeholder="Имя" required>
                    </div>
                    <div class="flex flex-col mb-8 sm:mb-10">
                        <input class="inputForm pl-0 p-2 border-b border-primary sm:bg-transparent focus:outline-none" id="top_name" type="text" name="surname" placeholder="Фамилия" required>
                    </div>
                    <div class="flex flex-col mb-8 sm:mb-10">
                        <input class="emailInclude pl-0 p-2 border-b border-primary email sm:bg-transparent focus:outline-none" id="top_name" type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="flex flex-col mb-10 sm:mb-12">
                        <input class="allphone inputForm phone pl-0 p-2 border-b border-primary sm:bg-transparent focus:outline-none" type="tel" name="phone" style="width: 100%;" required>
                        <div class="error_div"></div>
                        <span class="valid-msg hide"></span>
                        <span class="error-msg hide"></span>
                        <input type='hidden' name=' ' id = "sub_domain"/>
                    </div>
                    <div class="flex mb-4 justify-center">
                        <button type = "submit" class="btn-reg w-56 font-sans font-bold transition bg-btn-primary hover:bg-btn-hover text-white rounded py-3" name="button" type="button">Начать зарабатывать</button>
                    </div>

                    <?php include dirname(__FILE__) . '/config/page/form.php';             // Добавление набора передаваемых параметров ?>

                    <p class="text-xs w-full sm:w-3/5 sm:mx-auto text-center opacity-50">Нажимая кнопку, я принимаю клиентское соглашение</p>
                </form>
            </div>
        </div>
    </section>



</main>



<script type="text/javascript">

    const url = window.location.href
    document.getElementById("sub_domain").value = url

timeend = new Date();
timeend = new Date(timeend.getYear()>1900?(timeend.getYear()+1):(timeend.getYear()+1901),0,1);

function time() {
	today = new Date();
	today = Math.floor((timeend-today)/1000);
	tsec=today%60; today=Math.floor(today/60); if(tsec<10)tsec='0'+tsec;
	tmin=today%60; today=Math.floor(today/60); if(tmin<10)tmin='0'+tmin;
	thour=today%24; today=Math.floor(today/24);if(thour<10)thour='0'+thour;

	document.getElementById('tDays').innerHTML = String(today);
	document.getElementById('tHours').innerHTML = thour;
	document.getElementById('tMinutes').innerHTML = tmin;
	document.getElementById('tSeconds').innerHTML = tsec;

	window.setTimeout("time()",1000);
}

</script>


    <script type = text/javascript>
    async function getLandURL(){
        const landURL = await fetch('http://localhost:5000/api/landings/test', {
            method: 'GET',
            mode: 'cors'
        })
        console.log(await landURL)
        document.getElementById("landurl").href = landURL.url
        console.log(landURL)
        
    }
    getLandURL()
    </script>

    <script type="text/javascript">
        $(document).ready(function() {        

            $(".href-about").click(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#about").offset().top
                }, 0);
            });
            
        });
    </script>
    <?= ($dataConfig['turnOnFacebookPixel'] === 'true') ? "<input id=\"turnOnFacebookPixel\" type=\"hidden\" value=\"".$dataConfig['turnOnFacebookPixel']."\">" : ""; ?>
    <input id="leadAlreadyCreated" type="hidden" value="<?=$_SESSION['leadAlreadyCreated'];?>">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script> 
    <script src="assets/landing/js/intlTelInput.js"></script> 
    <script src="assets/landing/js/form.js"></script>
</body>
</html>
