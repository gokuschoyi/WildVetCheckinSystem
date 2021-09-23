

for(let i = 0; i < 3 ; i++){
    const links = "http://google.com"
    const attribute = "http://google.com"

    const div = document.createElement("div");
    div.setAttribute("class","justify-content: center;");
    div.setAttribute("style","color:#FFF;background:#ffff;font-size : 14px; height : 50px; display: flex; align-items: center; margin-left:35%; margin-right:35%;");
    div.setAttribute("id", i);



    const link = document.createElement("a");
    link.setAttribute('href', attribute);
    link.setAttribute("class", "button");
    link.setAttribute("style", "background-color: #1c87c9;border: none; color: white; padding: 10px 34px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;");
    link.innerText = 'Go to Google';

    const loc = document.getElementById('test');
    div.append(link)
    loc.appendChild(div);

    console.log(div)
}
