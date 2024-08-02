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





const $DDC = {
    _draggable : ($Elem)=>{
        //const $ControllerElem = $Elem.querySelector(".PositionIcon")
        $Elem.classList.add("DDC-item")
        const $ControllerElem = document.createElement("div")
        $ControllerElem.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0001 2.89331L8.81809 6.07529L9.87875 7.13595L11.2501 5.76463V11.2499H5.7649L7.13619 9.8786L6.07553 8.81794L2.89355 11.9999L6.07553 15.1819L7.13619 14.1212L5.76485 12.7499H11.2501V18.2352L9.87875 16.8639L8.81809 17.9245L12.0001 21.1065L15.182 17.9245L14.1214 16.8639L12.7501 18.2352V12.7499H18.2353L16.8639 14.1213L17.9246 15.1819L21.1066 11.9999L17.9246 8.81796L16.8639 9.87862L18.2352 11.2499H12.7501V5.76463L14.1214 7.13595L15.182 6.07529L12.0001 2.89331Z" fill="#080341"/>`;
        $ControllerElem.classList.add("PositionIcon")
        $Elem.querySelector(".body").append($ControllerElem)


        // $Event._customFunction = ()=>{
        //     alert("hi")
        // }
        // $Elem.addEventListener("myEvent",()=>{
 
        // },false);
        

        $ControllerElem.onmousedown = ()=>{ _onDragStart() }
        $ControllerElem.ontouchstart = ()=>{ _onDragStart() }     

        function _onDragStart(e){
            $Elem.classList.add("DDC-item-dragging")


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

        function _onDrop(){
            $Elem.classList.remove("DDC-item-dragging")
            $Elem.classList.remove("DDC-dragging")
            let elem = window
            elem.onmouseup = null;
            elem.onmousemove = null;     
            elem.ontouchend = null;
            elem.ontouchmove = null;

            elem.dispatchEvent(new CustomEvent("DDC-drop", {
                detail: {}
            }));

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
    


            let offsetTop =  y + (elem.getBoundingClientRect().height / 2)
            let offsetLeft = x - (elem.getBoundingClientRect().width / 2)

            
            // let left = (offsetLeft / window.innerWidth  * 100).toFixed(2) 
            // let top = (offsetTop / window.innerHeight  * 100).toFixed(2)


            elem.classList.add("DDC-dragging");


            // elem.style.top = top + "%";
            // elem.style.left = left + "%";  

            let mtop = (vminConversion(y) - (vminConversion(window.innerHeight) / 2)) - vminConversion(elem.getBoundingClientRect().height / 2); 
            let mleft = (vminConversion(x) - (vminConversion(window.innerWidth) / 2)) - vminConversion(elem.getBoundingClientRect().width / 2);
            //console.log(mtop)

            // elem.style.marginTop = mtop + "vmin";
            // elem.style.marginLeft = mleft + "vmin";  
            elem.dispatchEvent(new CustomEvent("DDC-update", {
                detail: {
                    "--componentY": mtop + "dvmin",
                    "--componentX": mleft + "dvmin"
                }
            }));
        }



    }
}

export default {
    install:(app) => {
      app.provide('$DDC', $DDC)
    }
}