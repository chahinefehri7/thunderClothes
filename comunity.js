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
                let dateNow = new Date();
                // dateNow = dateNow.getDate();
                console.log(dateNow);
    
                let UserName = document.createTextNode("Username");
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