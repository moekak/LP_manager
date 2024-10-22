export const insertDataToLocalstorage = (inputValue)=>{
    const ArrayString = JSON.stringify(inputValue);
    localStorage.setItem("data", ArrayString);
}

export const isLocalStorageDataExisted = () =>{
    const ObjectString  = localStorage.getItem("data");
    const data          = JSON.parse(ObjectString)
    return data;
}

export const unsetLocalStorage = (key) =>{
    localStorage.removeItem(key)
}
