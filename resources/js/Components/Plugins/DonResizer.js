
function vminConversion(n){
    let maxVmin = 0;
    let Wvmin = 0;
    if(window.innerWidth > window.innerHeight){
       //Landscape
      maxVmin = (window.innerWidth / window.innerHeight) * 100
      Wvmin = window.innerWidth
    }else{
      maxVmin = (window.innerHeight / window.innerWidth) * 100
      Wvmin = window.innerHeight
    }
    let num = (n / Wvmin  * maxVmin).toFixed(2) 
    return num
  }


const $DR = {
    _init : ($Elem,Hresize = false)=>{
        $Elem.classList.add("DR-item")
        const $ControllerElem = document.createElement("div")
        $ControllerElem.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 32 32" version="1.1">
        <path d="M25.99 6.042l-0.004 9.735-3.732-3.733-4.454 4.455-2.665-2.665 4.454-4.454-3.384-3.383 9.785 0.045zM11.494 22.805l3.238 3.182-9.722 0.017 0.004-9.68 3.815 3.815 4.925-4.924 2.665 2.665-4.925 4.925z"/>
        </svg>`;
        $ControllerElem.classList.add("ResizeIcon")
        $Elem.querySelector(".body").append($ControllerElem)       
        $ControllerElem.onmousedown = ()=>{ _onDragStart() }
        $ControllerElem.ontouchstart = ()=>{ _onDragStart() } 

        function _onDragStart(e){
            $Elem.classList.add("DR-item-resizing")
            e = e || window.event;
            e.preventDefault();

            $ControllerElem.onmousedown = ()=>{
                window.onmousemove = ()=>{ _onDragMove();}
                window.ontouchmove = ()=>{ _onDragMove();}
                window.onmouseup = ()=>{_onDrop();}
                window.ontouchend = ()=>{_onDrop();}
            }

            $ControllerElem.ontouchstart = ()=>{
                window.onmousemove = ()=>{ _onDragMove();}
                window.ontouchmove = ()=>{ _onDragMove();}
                window.onmouseup = ()=>{_onDrop();}
                window.ontouchend = ()=>{_onDrop();}
            }

        }     
        
        
        function _onDragMove(e){
            e = e || window.event;
                
            let elem = $Elem

            let x = e.pageX
            let y = e.pageY

            if(!e.touches){
                e.preventDefault();

    
            }else{
                x = e.touches[0].clientX
                y = e.touches[0].clientY
            }
    


            // let offsetTop =  y + (elem.getBoundingClientRect().height / 2)
            // let offsetLeft = x - (elem.getBoundingClientRect().width / 2)

            
            // let left = (offsetLeft / window.innerWidth  * 100).toFixed(2) 
            // let top = (offsetTop / window.innerHeight  * 100).toFixed(2)


            elem.classList.add("DR-dragging");


            console.log(x,y)
            // console.log(top,left)
            // elem.style.top = top + "%";
            // elem.style.left = left + "%";  

            // let mtop = (vminConversion(y) - (vminConversion(window.innerHeight) / 2)) - vminConversion(elem.getBoundingClientRect().height / 2); 
            // let mleft = (vminConversion(x) - (vminConversion(window.innerWidth) / 2)) - vminConversion(elem.getBoundingClientRect().width / 2);
            // console.log(mtop)

            // elem.style.marginTop = mtop + "vmin";
            // elem.style.marginLeft = mleft + "vmin";  
            
            let offsetLeft =  elem.offsetLeft + (elem.getBoundingClientRect().width / 2)
            let wDiff = x - offsetLeft
            let w = vminConversion(elem.getBoundingClientRect().width + wDiff)
            //console.log(w)
            // let w = vminConversion(x) +
            //  vminConversion(elem.getBoundingClientRect().width)
            let res = {'--componentW':null,'--componentH':null}
            if(Hresize){
                // elem.style.width = w+"vmin";
                // elem.style.height = w+"vmin";
                // elem.setAttribute("componentw",w+"vmin")
                // elem.setAttribute("componenth",w+"vmin")
                res['--componentW'] = w+"dvmin"
                res['--componentH'] = w+"dvmin"
            }else{
               // elem.style.width = w+"vmin";
                // elem.setAttribute("componentw",w+"vmin")
                // elem.setAttribute("componenth",null)
                res['--componentW'] = w+"dvmin"
            }

            elem.dispatchEvent(new CustomEvent("DR-update", {
                detail: res
            }));


        }


        function _onDrop(){
            $Elem.classList.remove("DR-item-dragging")
            $Elem.classList.remove("DR-dragging")
            let elem = window
            elem.onmouseup = null;
            elem.onmousemove = null;     
            elem.ontouchend = null;
            elem.ontouchmove = null;
        }


    }
}

export default {
    install:(app) => {
      app.provide('$DR', $DR)
    }
}