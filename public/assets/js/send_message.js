window.onload = () => {
    let link = document.querySelector('a.btn-send');
    link.addEventListener('click',(e)=>{
        e.preventDefault();
        //Le contenu du message
        let content_i = document.querySelector('input.content-i');
        //pseudo user 
        let pseudo = document.querySelector('input.user');
        //L'utilisateur
        let user = parseInt(pseudo.value);
        //console.log(user);

        //Le message
        let content_message = (content_i.value=='' ? "Hello boy !" : content_i.value);
        console.log(link.href);

        //Envoie de donnees
         axios.post(link.href, {
            recipient: user,
            message: content_message
          }).then(function(response) {
            //On treaite la reponse recu 
            const ul = document.querySelector('ul.history');
            let li = document.createElement('li');
            li.className = "clearfix";
            let message_data = document.createElement('div');
            let message = document.createElement('div');
            let span = document.createElement('span');
            message.className = "message my-message";
            message_data.className = "message-data";
            span.className = "message-data-time";
            span.textContent = moment(response.data.date.date).fromNow();//response.date.date;
            message.textContent = response.data.message;
            message_data.appendChild(span);

            li.appendChild(message_data);
            li.appendChild(message);
            ul.appendChild(li);
            console.log(response);

          }).catch(function(error) {
            console.log(error);
          })

        
    })

}

   