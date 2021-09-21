

for(let i = 0; i < 3 ; i++){
    const div = document.createElement("div");
    div.setAttribute("class","display: flex; justify-content: center;");
    div.setAttribute("id", i);
    div.setAttribute("style","color:#FFF;background:#ffff;font-size : 14px; height : 50px; display: flex; align-items: center;");
   
    const button = document.createElement('button');
    button.setAttribute("class", "btn btn-primary");
    button.setAttribute("style","height : 30px; width : 100px")
    button.setAttribute("type", "button");
    button.textContent = "Click Here";
    
    const link = document.createElement("a");

    const attribute = "http://google.com"
    
    link.setAttribute('href', attribute);
    link.innerText = 'Go to Google';
    console.log(div)
    //a.innerHTML = "<a href  = "www.google.com"> test </a>"
    const loc = document.getElementById('test');
    div.append(button)
    loc.appendChild(div);
}
