import { useRef, useState } from 'react'

import './App.css'

function App() {
  const [name,setName]=useState('');
  const [response,setResponse]=useState('')
  const selectedFile=useRef();
  const retriever=async()=>{
    var xhr=new XMLHttpRequest()
    xhr.open('POST','http://localhost/php/images/upload.php');
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.onload=function(){
      // setResponse(this.responseText);
      console.log(this.responseText);
    }
    xhr.send(`fetch`)
  }

  
  const uploader=async()=>{
   
   
    if(selectedFile.current.files.length===0){
     setResponse("please choose an image")
    }
    else{
      const formData=new FormData();
      formData.append("picture",selectedFile.current.files[0]);
      formData.append("name",name);
      var xhr=new XMLHttpRequest();
      xhr.open('POST','http://localhost/php/images/upload.php',true);
      
      xhr.onload=function(){
        // setResponse(this.responseText);
        if(this.responseText==='success'){
          retriever();  
        }
        console.log(this.responseText);
      }
      xhr.send(formData)
    }
  
  }

  
  return(
<div className='app'>
  <h2>File Uploading in reactjs</h2>
  <p>{response}</p>

 <input type="text" onChange={(e)=>setName(e.target.value)}/>
 <input type="file" ref={selectedFile}/>
 <button onClick={uploader}>Upload</button>
</div>
  )

  
}

export default App
