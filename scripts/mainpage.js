// JavaScript Document
var loopIndex=0;
var timer=null;
var alpha=0;
var timer2=null;


window.onload=function(){
  var oSilde=document.getElementById("slide");
  // set the interval time of photo slide
  timer=setInterval(function(){autoloop()},5000);
  // change position of elements in header bar to make a fancy style
  window.onscroll=function(){
    var t=document.documentElement.scrollTop||document.body.scrollTop;
    if( t >= document.getElementById("slide").offsetHeight-document.getElementById("cover").offsetHeight){
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[0].className="active";
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[1].className="active";
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[2].className="active";
      document.getElementsByClassName("cover")[0].style.position="absolute";
      document.getElementsByClassName("headtext")[0].style.position="absolute";
      document.getElementsByClassName("genrelist")[0].style.position="absolute";

      document.getElementsByClassName("cover")[0].style.bottom=0;
      document.getElementsByClassName("cover")[0].style.top=document.getElementById("slide").offsetHeight-document.getElementById("cover").offsetHeight+"px";
      document.getElementsByClassName("headtext")[0].style.bottom=0;
      document.getElementsByClassName("headtext")[0].style.top=document.getElementsByClassName("cover")[0].style.top;
      document.getElementsByClassName("genrelist")[0].style.bottom=0;
      document.getElementsByClassName("genrelist")[0].style.top=document.getElementsByClassName("cover")[0].style.top;
    }
    else{
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[0].className="";
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[1].className="";
      document.getElementsByClassName("headtext")[0].getElementsByTagName("span")[2].className="";
      document.getElementsByClassName("cover")[0].style.position="fixed";
      document.getElementsByClassName("headtext")[0].style.position="fixed";
      document.getElementsByClassName("cover")[0].style.top=0;
      document.getElementsByClassName("genrelist")[0].style.position="fixed";
      document.getElementsByClassName("genrelist")[0].style.top=0;
      document.getElementsByClassName("headtext")[0].style.top=document.getElementsByClassName("cover")[0].style.top;
    }
  };
  // when one social circle is horvered, the class name will be added to it to make it has css style
  var foot=document.getElementsByClassName("social-circle");
  var a=foot[0].getElementsByTagName("a");

  for(var j=0; j<a.length; j++){
    a[j].onmouseover=function(){
      var id=this.id;
      this.classList.add(id);
    };
    a[j].onmouseout = function(){
      var id=this.id;
      this.classList.remove(id);
    };
  }

}
function startMove(obj, target){
  // prevent interval time overlap
  clearInterval(timer2);
  var speed=0;
  alpha=20;
  timer2=setInterval(function(){

    if (alpha< target){
      speed=5;
    }
    else{
      speed=-5;
    }
    if (alpha==target){
      clearInterval(timer2);
    }
    else{
      alpha+=speed;
      obj.style.opacity=alpha/100;
      obj.style.filter="alpha(opacity:"+alpha+")";
    }
  },100);
}
function autoloop(){
  if(loopIndex==7){
    loopIndex=-1;
  }
  var oSilde=document.getElementById("slide");
  var oImage=document.getElementById("image");
  var aImg=oSilde.getElementsByTagName("img");
  var adiv=oImage.getElementsByTagName("div");
  loopIndex++;
  for(var i=0; i<aImg.length; i++){
    if(i == loopIndex){
      aImg[i].style.display="block";
      adiv[i].style.display="block";
    }
    else{
      aImg[i].style.display="none";
      adiv[i].style.display="none";
    }
  }

}
