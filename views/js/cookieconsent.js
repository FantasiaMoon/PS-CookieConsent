policy_link = cookieconsent.policy_link;
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#efefef",
      "text": "#404040"
    },
    "button": {
      "background": "#8ec760",
      "text": "#ffffff"
    }
  },
  "position": "bottom-left",
  "content": {
	"message": "This website uses cookies to improve your site experience. By continuing, you consent to our cookies.",
    "href": policy_link
  }
})});
