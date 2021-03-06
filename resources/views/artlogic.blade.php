<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Artlogic FE Task</title>

        <!-- Web3 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.3.4/web3.min.js" integrity="sha512-TTGImODeszogiro9DUvleC9NJVnxO6M0+69nbM3YE9SYcVe4wZp2XYpELtcikuFZO9vjXNPyeoHAhS5DHzX1ZQ==" crossorigin="anonymous"></script>

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/e391ce7786.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:800px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: Calibre,Sans-Serif;
            }
            div.relative {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            #mast {
                position:relative;
                top:0;
                left:0;
            }
            #faq {
                height: 100%;
                position:relative;
                top:0;
                left:0;
            }
            #mast .overlay {
                position: relative;
            }
            #mast .overlay span, #mast .overlay h1, #mast .overlay p {
                position: absolute;
                width: 100%;
                color: #fff;
                padding-left: 15px;
                padding-right: 15px;
                margin-left: 50px;
                line-height: 1.2;
                text-align: left;
                font-weight: 600;
            }
            #mast .overlay span {
                top: -758px;
                font-size: 25px;

            }
            #mast .overlay h1 {
                top: -480px;
                font-size: 54px;
                width: 75%;
            }
            #mast .overlay p {
                bottom: 60px;
                font-size: 24px;
                width:65%;
            }
            #mast .overlay p span {
                width: 60px;
                border-top: 1px solid white;
                top: -25px;
                left:0;
                margin-left:15px; !important;
            }
            #mast .image-container, #faq .container {
                display: inline-block;
                height: 800px;
            }
            picture img {
                width: 100%;
                /* width: 1349px; */
                height: 100%;
                display: inline-block;
                object-fit: cover;
                object-position: top;
            }
            .max-w-6xl {
                max-width: 70rem;
            }

            @media only screen and (max-width: 960px) {
                #mast .overlay h1 {
                    font-size: 42px;
                }
                #mast .overlay p {
                    width:65%;
                }
            }

            @media only screen and (max-width: 800px) {
                #mast .overlay span {
                    top: -670px;
                    font-size: 25px;
                }
                #mast .overlay h1 {
                    font-size: 54px;
                    width: 60%;
                }
                #mast .overlay p {
                    width: 50%;
                }
                #faq .container {
                    height: 1000px;
                }
                #mast .image-container {
                    height: 1600px;
                }
                picture img {
                    height: 100%;
                    display: inline-block;
                    object-fit: cover;
                    object-position: -900px 700px;
                    position: relative;
                }
            }

            @media only screen and (max-width: 680px) {
                #mast .overlay span {
                    font-size: 25px;
                }
                #mast .overlay h1 {
                    font-size: 44px;
                    width: 60%;
                }
                #mast .overlay p {
                    width: 60%;
                }
            }

            @media only screen and (max-width: 520px) {
                #mast .overlay span {
                    font-size: 25px;
                }
                #mast .overlay h1 {
                    font-size: 38px;
                    width: 80%;
                }
                #mast .overlay p {
                    width: 85%;
                }
            }

            /* ------------------------------------- */

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                height: 100Vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container{
                width: 600px;
                max-width: 600px;
                height: auto;
                padding: 0px 50px;
            }
            .container span {
                padding: 50px 0px;
                display: block;
                font-size: 24px;
                border-bottom: 1px solid #ccc;
            }
            .element{
                background: none;
                padding-top: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #ccc;
            }
            .element .question{
                display: flex;
                justify-content: space-between;
            }
            .question h3, .answer p {
                line-height: 1.5;
                text-align: left;
                font-weight: 400;
                font-size: 14px;
            }
            .question h3 {
                font-weight: 600;
            }
            .answer p {
                padding-top: 30px;
                padding-bottom: 20px;
            }
            .question button{
                border: none;
                outline: none;
                background: none;
                cursor: pointer;
            }
            .question i{

            }
            .element .answer{
                animation: animate .7s;
            }
            p{
                font-family: sans-serif;
            }
            .question {
                cursor: pointer;
            }
            @keyframes animate{
                from{
                    opacity: 0;

                }
                to{
                    opacity: 1;

                }
            }
            .hide {
                display:none;
            }
            div.relative {
                padding-top: 0;
                padding-bottom: 0;
            }



        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top min-h-screen bg-white-100 dark:bg-white-900 sm:items-center sm:pt-0">


            <div class="max-w-6xl mx-auto">

                <div class="bg-white dark:bg-white-800 overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 overflow-hidden">

                        <div id="mast" class="border-white-200 overflow-hidden">
                                <div class="image-container text-gray-600 dark:text-gray-400 text-sm">
                                    <picture>
                                        <img class="banner" src="https://distractionless.com/background-c.jpg" alt="">
                                    </picture>
                                </div>
                                <div class="overlay text-gray-600 dark:text-white text-sm">
                                    <span>Artlogic</span>
                                    <h1>Improve your website SEO</h1>
                                    <p><span></span>Some FAQs on search engine optimisation</p>
                                </div>
                        </div>

                        <div id="faq" class="border-gray-200 overflow-hidden">
                            <div class="flex items-center">
                                <div id="root" class="container text-lg leading-7 font-semibold text-gray-900 dark:text-gray-900 overflow-hidden">
                                    <span>Questions</span>
                                    @foreach ($params as $nr => $item)
                                        <div class="element">
                                            @foreach ($item as $key => $value)
                                                @if ($key === 'title')
                                                    <div class="question">
                                                        <h3>{{ $nr+1  }}. {{ $value }}</h3>
                                                        <button><i class="fas fa-solid fa-caret-up"></i></button>
                                                    </div>
                                                @else
                                                    <div class="answer hide">
                                                        <p>{{ $value }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>


            // Accordion VanillaJS
            const elements = document.querySelectorAll('.element');
            elements.forEach(element =>{
                let btn = element.querySelector('.question');
                let icon = element.querySelector('.question button i');
                var answer = element.lastElementChild;
                var answers = document.querySelectorAll('.element .answer');
                btn.addEventListener('click', ()=>{
                    answers.forEach(ans =>{
                        let ansIcon = ans.parentElement.querySelector('button i');
                        if(answer !== ans){
                            ans.classList.add('hide');
                            ansIcon.className = 'fas fa-solid fa-caret-up';
                        }
                    });
                    answer.classList.toggle('hide');
                    icon.className === 'fas fa-solid fa-caret-up' ? icon.className = 'fas fa-solid fa-caret-down'
                        : icon.className ='fas fa-solid fa-caret-up';
                });
            });

        </script>
    </body>
</html>
