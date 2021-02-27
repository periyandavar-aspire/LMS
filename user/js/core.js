var slideIndex=0;
function slideshow(){
    const slides=document.getElementsByClassName('slide');
    
    for (const slide of slides) {
        slide.style.display="none";
    }
    if(slideIndex<0){
        slideIndex=slides.length-1;
    }
    else if(slideIndex>slides.length-1){
        slideIndex=0;
    }
    slides[slideIndex].style.display="block";
    slideIndex=slideIndex+1;
    setTimeout(slideshow,7000,);
}
function changeSlide(index){
    const slides=document.getElementsByClassName('slide');

    for (const slide of slides) {
        slide.style.display="none";
    }
    if(index<0){
        index=slides.length-1;
    }
    else if(index>slides.length-1){
        index=0;
    }
    slides[index].style.display="block";
    slideIndex=index+1;
}