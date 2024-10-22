export const  clearInputField = ()=>{
    const elements = ["js_lp_name", "js_lp_domain", "js_lp_content", "js_lp_group"]

    for(let i = 0; i < elements.length; i ++){
        if(document.querySelector(`.${elements[i]}`) !== null){
            document.querySelector(`.${elements[i]}`).value = "";
        }

    }
}