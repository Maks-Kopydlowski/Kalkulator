addEventListener("keypress", (event) => {
    if(event.key === "Enter" || event.keyCode === 13){
        document.getElementById("button").click();
    }
})