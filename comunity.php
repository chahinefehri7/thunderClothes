<?php
include 'connect-db.php';
if($_COOKIE['userPhoneNumber']==""){
    header("location:signin.html");
}
$userphoneNumber = $_COOKIE['userPhoneNumber'];
$findUserRq = "SELECT * FROM `clients` WHERE phoneNumber=$userphoneNumber";
$findUserResult = mysqli_query($conn,$findUserRq);
if(mysqli_num_rows($findUserResult)<1){
    setcookie("userPhoneNumber" , "");
    header("location:userNotFound.html");
}else{
    $UserRows = $findUserResult->fetch_assoc();
    $UserFullName = $UserRows['name'] ." ". $UserRows['lastName'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&family=Brygada+1918:ital,wght@0,400..700;1,400..700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sedan:ital@0;1&display=swap" rel="stylesheet">
    <title>web site</title>
    <link rel="stylesheet" href="comunity.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    *{
        padding: 0;
        margin: 0;
    }
    body{
        overflow-x: hidden;
        scroll-behavior: smooth;
    }
    .hidden3:nth-child(1){
        transition-delay:400ms;
    }
    .hidden3:nth-child(1){
        transition-delay: 100ms;
    }
    .hidden{
        filter: blur(5px);
        scale: 1.08;
    }
    .show{
        filter: blur(0);
        scale: 1;
    }
</style>
<body>
    <header style="width: 90%;">
        <a href="index.html"><h2>Thunder<i>Clothes</i></h2></a>
        <ul>
            <a href="#"><li>Store</li></a>
            <a href="#"><li>About us</li></a>
            <a href="#"><li>Sign in</li></a>
        </ul>
    </header>
    <main>
        <div class="community-title" style="height: fit-content;">
            <h1 class="hidden">
                LOVE WHAT YOU WEAR! <br>
                THINGS YOU HEAR <br> WHEN YOU <br>
                WEAR <i>Thunder Clothes.</i> <br>
            </h1>
            <p class="hidden">it's the idea of wearing artistic thing with meaningfull content and ideas <br>
                welcom to our shop
            </p>
        </div>
        <div class="news">
            <div class="news-discription hidden3" id="news">
                <h1>Thunder Story.</h1>
                <h4>They Don't Care!</h4>
                <p >
                    when talking about thunder clothes we're talking about being interested in artistic things 
                    so we try to come with new ideas and news for you ofc it need to be an artistic, creative,meaningful, and goergious products .<br>
                    what we can't do is change your mind from what you really like and taste in things to your way of thinking.and we really want to open your mind befor your eyes to the truth but lets talk about what is real. <br>
                    and stand together to spread out this art and messages from the North Africa . things just tunisian people will understand and mature. <br>
                    and what we should talk about for a way too long.
                    thunder clothes present to you some of the issues that we all know and denye . <br>
                    <i>"the goverment"</i>
                    its like a rich and creminal community who can do whatever costs for the leadering and value Acting like they care about people and want the best for them
                    but it actually don't Care at all. <br>
                    we Need to wake up and realize that we people need to help and stand for each other. <br>
                    in those days where we can't trust no body where everyone wake up with the only goal is trying to survive <br>
                    in this none trust worthy country. <br>
                    so we the people are the first problem in all this propaganda and mess. <br>
                    <br>...<i>Wake Up People!</i>
                </p>
            </div>
            <div class="newsImg hidden3">
                <nav>
                    <h1>The goverment does not care!</h1>
                    <p>if you think that some people fight to have </p>
                </nav>
                <div class="theNewsImg">
                    <img src="images/IMG_3912.JPG" alt="the news" style="object-fit: fill;">
                </div>
            </div>
        </div>
        <nav class="scroll-down" id="scrollDown">
            <img src="images/scroll-bar.png" alt="scroll down">
        </nav>
        <hr>
        <div class="thunder-Ad" onmouseover="AdAnimation(this)" onmouseout="AdAnimationOff(this)">
           <nav>
            <h1>Take a Look</h1>
            <i><p>you can take a look on whats coming soon don't worrey bud we will keep you updated <br><a href="comingSoon.html">Click Here</a></p></i>
            <a href="store.html"><button class="btn" id="eyes">Check it Now</button></a>
           </nav>
            <nav>
                <img src="images/pain-eye.png" id="paineyes" style="transition: 2s;">
            </nav>
        </div>
        
        <div class="comunity">
            <h1>Community is Talking</h1>
            <p>Thunder clothes is not just a clothing Brand it's a New way of thinking <br> people can say their opinion outloud and Talk about what they really think about issues we need to solve</p>
            <div class="talking-section">
                <nav class="hidden3">
                    <img src="images/IMG_3913.JPG" alt="">
                </nav>
                <nav  class="hidden3">
                    <div class="comunity-header">
                        <h1>Talking About..</h1>
                        <p>if we human didn't create justice would it be a huge mess in the World?</p>
                    </div>
                    <div id="comunityTalkSection-container" class="comunityTalkSection-container">
                        <div id="comunityTalkSectionPost1" class="comunityTalkSection">
                            <div class="cmnt thunder hidden">
                                <span></span>
                                <div>
                                    <nav>
                                        <img src="images/thunder-logo.png" alt="thunder logo">
                                    </nav>
                                    <nav>
                                        <h4 class="name">Thunder Clothes</h4>
                                        <p class="content">Here where you can feel free and talk with the community of thunder, feel free</p>
                                    </nav>
                                </div>
                                <small class="time">1m ago</small>
                            </div>
                        </div>
                        <a href="#top" id="comunityTalkSectionTop"></a>
                    </div>
                    <div class="post"><input type="text" name="comunityTalk" id="comunityTalkInputPost1" class="comunityTalkInput" placeholder="What do you think About This...?"><button id="Post1" onclick="post(this)">POST</button></div>
                </nav>
            </div>
        </div>
        <!-- <div class="collection">
            <nav>
                <a href="buy.php">
                    <div class="productImg">
                    <img src="images/" alt="">
                </div>
                </a>
                <div class="product-info">
                    <p class="soldout">sold out</p>
                    <h4>Thunder New Collection</h4>
                    <p class="product-price">00.00TND</p>
                </div>
            </nav>
            <nav>
                <a href="buy.php">
                    <div class="productImg">
                    <img src="images/" alt="">
                </div>
                </a>
                <div class="product-info">
                    <p class="soldout">sold out</p>
                    <h4>Thunder New Collection</h4>
                    <p class="product-price">00.00TND</p>
                </div>
            </nav>
            <nav>
                <a href="buy.php">
                    <div class="productImg">
                    <img src="images/" alt="">
                </div>
                </a>
                <div class="product-info">
                    <p class="soldout">sold out</p>
                    <h4>Thunder New Collection</h4>
                    <p class="product-price">00.00TND</p>
                </div>
            </nav>
            <nav>
                <a href="buy.php">
                    <div class="productImg">
                    <img src="images/" alt="">
                </div>
                </a>
                <div class="product-info">
                    <p class="soldout">sold out</p>
                    <h4>Thunder New Collection</h4>
                    <p class="product-price">00.00TND</p>
                </div>
            </nav>
        </div> -->
        <div class="news">
            <div class="news-discription hidden3" id="news2">
                <h1>Thunder Story.</h1>
                <h4>Reminder. You are Going To Die</h4>
                <p>
                   Talking about Death.
                   the first impression that comes to you being afraid or you start thinking of it . 
                   its the fear of the end. <br>
                   that you're no longer exist only in those people who loves you but don't worrey that will not last for too long.
                   those people have life to continue and move on ,
                   always Remmember that the mind is a great friend, and always try to protect you from being sad.
                   by forgetting things and move on.
                   heart breaks, Fake friends, waistig money, what you eat yesterday... and <i>"Death"</i> of people we love.
                   so your mind is trying to keep his prioritys clear and only remmember things that he sees important or you need to recall in the future.
                   so things that will disturb you through the way , get thrown in the basket where all your bad thought and things you don't wanna remmember get stored in your "inner mind" .
                   which is the most powerful and controling thing on your self being and your true identity of existance.
                   and one of those bad thought is <i>Death</i> , and the way we accept it . 
                   some people wanna mention it as the end of you , or you're no longer exist and became as a part of the ground , as a part of the mother nature from where we all begin, the starting point .
                   and some other with belives and they rely on something that is more stronger and powerful most of us humans call "God","Lord"... with different prespectives and sometimes you disagree and you start looking at other belifs and wondering.
                   what makes them think that's a god or something powerful, some people make and create with any thing by their bair hands and pretend that's the thing who created them and created the whole univers and belif in theirselfs as that's the thing woh they can rely on at their lowest.
                   to get away bad thoughts inside their mind and give hope for the future to feel safe at the very bad moments and thoughts and to keep yourself out of trouble.
                   im not el religion guy but from my prespective if you do some deep reaearch or by following your heart and think with your mind you will know the truth and the most logical religion that you can put all your belif on. and i think we all know what it is.
                   but in every religion or belives there in some part of their story the idea of stopExisting and the end of the human get mention as <i>"Death"</i>
                   and a most of people will tell you that the human is an important being that god created to test his human true belive in him and there is life after death.
                   and it's a great way to minimize the fear of death.
                   we need to normalize and accept that we're all are going to die one day.
                   but the real fear is what we've done in thos days when we're alive.
                   and hope that we did the best.
                   we forget the idea of living and focus on the end of it.
                   what will happen after?
                   am i going to hell?
                   am i good enough?
                   and knowing well that the life is full of bad people that you can't be a Good person arond, or yo will suffer from them.
                   so focus on your self try to balance your life try to do something that people can remmember your name with, make history!
                   not all of us have those thoughts to be a better person befor Death befor the end of the story.
                   the story just you who know and you're the only one who read it multiple you write it and life choose what you will write about. and at some point you get rid of writing and you lose passion, life leaves you with no jubject to write about you're forced to quit writing.
                   thats when its your time .
                   so you close the book and put your pen down. and rest forever.
                   so what we need to focus on is writing a good book that you enjoy reading it , and memorized to the people who is passing by ,
                   the people who notice those lines of memories and actions . 
                   so enjoy every day even if you had a miserable life.
                   life a good life and enjoy it and stay a good person becaus its not the end.
                   there is <i>"HEAVEN"</i> and <i>"HELL"</i>
                </p>
            </div>
            <div class="newsImg hidden3">
                <nav>
                    <h1>We all going to die</h1>
                    <p>don't get afraid to die its a normal thing</p>
                </nav>
                <div class="theNewsImg">
                    <img src="images/Death.jpeg" alt="the news" style="object-fit: fill;">
                </div>
                <div class="theNewsImg"></div>
            </div>
        </div>
        <nav class="scroll-down" id="scrollDown2">
            <img src="images/scroll-bar.png" alt="scroll down">
        </nav>
        <div class="Fashion-News">
            <nav class="hidden3">
                <div>
                    <h1>Fashion News!</h1>
                    <p>
                        with Fashion News You can Stay Updated on whats New in the world of fashion
                        with <i>Thunder Fshion News</i> we can know our community Likes or not and Your opnion on whats happening those day or what you want to share with People
                        about fashion, street wear, reality, facts, things that should change in the recent time whtever runs in your mind .
                    </p>
                </div>
            </nav>
            <nav class="hidden3">
                <img src="images/IMG_3906.JPG" alt="thunder illustration" class="illustration">
            </nav>
        </div>
        <hr style="margin-top: 50px;">
        <div class="comunity">
            <h1>Community is Talking</h1>
            <p>Thunder clothes is not just a clothing Brand it's a New way of thinking <br> people can say their opinion outloud and Talk about what they really think about issues we need to solve</p>
            <div class="talking-section">
                <nav class="hidden3">
                    <img src="images/IMG_3942.JPG">
                </nav>
                <nav  class="hidden3">
                    <div class="comunity-header">
                        <h1>Talking About..</h1>
                        <p>Talk about your experience with tunisian police Good or Bad..</p>
                        <hr style="margin: 5px 0; width: 80%;">
                        <i><small>if you had a bad experience tell us what happen and what's things people should do to stop that</small></i>
                    </div>
                    <div id="comunityTalkSection-container" class="comunityTalkSection-container">
                        <div id="top" class="top" style="visibility: hidden; height: 10px;"></div>
                        <div id="comunityTalkSectionPost2" class="comunityTalkSection">
                        <div class="cmnt thunder hidden">
                                <span></span>
                                <div>
                                    <nav>
                                        <img src="images/thunder-logo.png" alt="thunder logo">
                                    </nav>
                                    <nav>
                                        <h4 class="name">Thunder Clothes</h4>
                                        <p class="content">Here where you can feel free and talk with the community of thunder, feel free</p>
                                    </nav>
                                </div>
                                <small class="time">1m ago</small>
                            </div>
                        </div>
                        <a href="#top" id="comunityTalkSectionTop"></a>
                    </div>
                    <div class="post"><input type="text" name="comunityTalk" id="comunityTalkInputPost2" class="comunityTalkInput" placeholder="What do you think About This...?"><button id="Post2" onclick="post(this)">POST</button></div>
                </nav>
            </div>
        </div>
        <!-- <div class="news">
            <div class="news-discription hidden3">
                <h1>Thunder Story.</h1>
                <h4>We Are Not Free Until Everyone is Free!</h4>
                <p>
                    Being free is a common thing people always Talk ab
                </p>
            </div>
            <div class="newsImg hidden3">
                <nav>
                    <h1>What You Looking For</h1>
                    <p>stay tuned with thunder clothes you can miss some good shit Right here</p>
                </nav>
                <div class="theNewsImg" style="width: 100%; height: 85%;">
                    <img src="images/IMG_3915.JPG" alt="the news" class="theNewsImg">
                </div>
            </div>
        </div> -->
    </main>
    <footer>
        <h1>Thunder Clothes</h1>
        <p>You can check our social media and stay tuned</p>
        <div>
            <nav>
                <h3>Thunder Email</h3>
                <form action="EmailComunity.php" method="post">
                    <input type="text" name="sendUsEmail" id="sendUsEmail" placeholder="Email"><br>
                    <input type="submit" value="submit" id="emailBtn">
                </form>
            </nav>
            <nav>
                <h3>Our Social Media</h3>
                <nav class="socialmedia">
                    <a href="https://www.facebook.com/thunderclothes.tn" target="_blank"><img src="images/facebook.png"></a>
                    <a href="https://www.instagram.com" target="_blank"><img src="images/instagram.png"></a>
                    <a href="https://x.com/ThunderClothe" target="_blank"><img src="images/twitter.png"></a>
                    <a href="https://www.tiktok.com/@thunderclothes" target="_blank"><img src="images/tiktok.png"></a>
                </nav>
                <a href="aroundTheWorld.html"><img src="images/aroundtheworldicon.png" class="aroundtheworldicon"></a>
            </nav>
        </div>
        <nav class="devId">Made By Chahine Fehri</nav>
    </footer>
    <!-- <script src="comunity.js"></script> -->
    <script>
        // first observer for elements animation
        const observer = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show');
                }else{
                    entry.target.classList.remove('show');
                }
            });
        });

        const hiddenElements = document.querySelectorAll('.hidden');
        hiddenElements.forEach((el) => observer.observe(el));

        // second observer for other elements animation
        const observer2 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show2');
                }else{
                    entry.target.classList.remove('show2');
                }
            });
        });

        const hiddenElements2 = document.querySelectorAll('.hidden2');
        hiddenElements2.forEach((el) => observer2.observe(el));
        // third observer for elements animation key frame
        const observer3 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show3');
                }else{
                    entry.target.classList.remove('show3');
                }
            });
        });

        const hiddenElements3 = document.querySelectorAll('.hidden3');
        hiddenElements3.forEach((el) => observer3.observe(el));
        // third observer for the left sliding elements  check the css for it
        const observer4 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show4');
                }else{
                    entry.target.classList.remove('show4');
                }
            });
        });

        const hiddenElements4 = document.querySelectorAll('.hidden4');
        hiddenElements4.forEach((el) => observer4.observe(el));
    </script>
    <script>
            
            // var post = document.getElementById('post');
            function post(section){
            let postId = section.id;
            let sectionId = "comunityTalkSection"+postId;
            let comunityTalkInputId= "comunityTalkInput"+postId;
            let comunityTalkInput = document.getElementById(comunityTalkInputId);

            if(comunityTalkInput.value==""){
                alert("Please Write Something")
            }else{

                let comunityTalkSection = document.getElementById(sectionId);
    
                let cmnt = document.createElement('div');
                let span = document.createElement('span');
                let h4cmnt = document.createElement('h4');
                let p = document.createElement('p');
                let cmntTime = document.createElement('small');
                // setting the date
                var formatter = new Intl.RelativeTimeFormat('en');
                let dateNow = new Date();
                // dateNow = dateNow.getDate();

                var UserName = '<?= $UserFullName?>';
                let UserName = document.createTextNode(Username);
                inputV = comunityTalkInput.value;
                comunityTalkInput.value ="";
                let theComment = document.createTextNode(inputV);
                cmntTime.innerHTML = dateNow;
    
                cmnt.classList.add('cmnt');
                h4cmnt.classList.add('name');
                p.classList.add('content');
                cmntTime.classList.add('time');
    
    
                cmnt.appendChild(span);
                h4cmnt.appendChild(UserName);
                p.appendChild(theComment);
                cmnt.appendChild(h4cmnt);
                cmnt.appendChild(p);
                cmnt.appendChild(cmntTime)
                comunityTalkSection.prepend(cmnt);
                console.log("posted :"+theComment.textContent);
            }
            // comunityTalkSectionTop.click()

        }
    </script>
    <script>
        function AdAnimation(ad){
            ad.classList.add("adAnimation");
        }
        function AdAnimationOff(ad){
            ad.classList.remove("adAnimation");
        }

        var eyes = document.getElementById('eyes');
        var paineye = document.getElementById('paineyes');

        eyes.addEventListener('mouseover' , ()=>{
            paineye.src = "images/pain-eye2.png";
        })
        eyes.addEventListener('mouseout' , ()=>{
            paineye.src = "images/pain-eye.png";
        })
        var news = document.getElementById('news');
        var scrollDownIcon = document.getElementById('scrollDown');
        news.addEventListener('mousewheel' , ()=>{
            scrollDownIcon2.style.opacity ="0";
            scrollDownIcon.style.margin ="0";
        })
        news.addEventListener("scroll" , ()=>{
            scrollDownIcon.style.opacity ="0";
            scrollDownIcon.style.margin ="0";
        })
        var news2 = document.getElementById('news2');
        var scrollDownIcon2 = document.getElementById('scrollDown2');
        news2.addEventListener('mousewheel' , ()=>{
            scrollDownIcon2.style.opacity ="0";
            scrollDownIcon2.style.margin ="0";
        })
        news2.addEventListener("scroll" , ()=>{
            scrollDownIcon2.style.opacity ="0";
            scrollDownIcon2.style.margin ="0";
        })
    </script>
</body>
</html>