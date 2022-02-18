 function onClickLink(event){
                event.preventDefault();
                let ul = document.querySelector('ul.history');
                let div_send = document.getElementById('send');
                let lien = document.querySelector('a.btn-send');
                for (let i =0 ; i<ul.children.length; i++) {
                    ul.removeChild(ul.children[i]);
                }
                for (let i =0 ; i<div_send.children.length; i++) {
                    if (div_send.children[i]!==lien) {
                        div_send.removeChild(div_send.children[i]);
                    }
                }
                const url = this.href;
                const divMessage = document.querySelector('div.js-message');
                

                //On recupere le pseudo de l'utilisateur connecte
                const pseudo = document.querySelector('h6.pseudo');
                let textPseudo = pseudo.textContent;
                //let obj = {user: textPseudo};
                //let jsonPseudo = JSON.stringify(obj,null);
                //console.log(jsonPseudo);
                //ul.removeChild(ul.firstChild);


                 //Pour les envois de message
                
                let input_content = document.createElement('input');
                let input_user = document.createElement('input');
                input_content.type = "text";
                input_content.className = "content-i form-control";
                input_content.placeholder = "Enter text here...";
                input_content.id = "input-content";
                div_send.appendChild(input_content);
                
                input_user.type = "text";
                input_user.className = "user form-control";
                input_user.hidden = "hidden";
                input_user.value = this.name;
                input_user.id = "input-content";

                div_send.appendChild(input_user);
                //console.log(input_user.value);
                
                
                lien.removeChild(lien.firstChild);
                let i = document.createElement('i');
                i.className = "fa fa-send";
                lien.appendChild(i);


                

                axios.get(url).then(function(response){

                    if (response.data.length>0) {
                        for (let i=0 ; i<response.data.length ;  i++) {

                        let li = document.createElement('li');
                        li.className = "clearfix";
                        let message_data = document.createElement('div');
                        let message = document.createElement('div');
                        let span = document.createElement('span');
            
            
                        if (textPseudo.includes(response.data[i].emmeteur)) {
                            message.className = "message my-message";
                            message_data.className = "message-data";
                        }
                       
                        else{
                            console.log(response.data[i].emmeteur);
                            message_data.className = "message-data text-center text-info";
                            message.className="message other-message float-right";
                            let img = document.createElement('img');
                            img.src = "https://bootdey.com/img/Content/avatar/avatar7.png";
                            message_data.appendChild(img);
                        }
                        span.className = "message-data-time";
                        span.textContent = moment(response.data[i].date.date).fromNow();//response.data[i].date.date;

                        message.textContent = response.data[i].contenu_message;

                        message_data.appendChild(span);

                        li.appendChild(message_data);
                        li.appendChild(message);
                        ul.appendChild(li);
                        //console.log(response);
                    }
                }
                else{
                    let h1 = document.createElement('h1');
                    h1.className = "m-5";
                    h1.textContent = "Start a chat";
                    ul.appendChild(h1); 
                }

                    
                     
                }).catch(function(error){
                    if (error.response.status === 403) {
                        window.alert('Vous n\'êtes pas connecté');
                        //event.stopPropagation();
                    }
                    else window.alert('Une erreur s\'est produite');
                });

                 for (let i =0 ; i<ul.children.length; i++) {
                    ul.removeChild(ul.children[i]);
                }  




}
document.querySelectorAll('a.js-link').forEach(function (link){
        link.addEventListener('click',onClickLink);
})