// Create a class for the element
class formInput extends HTMLElement {
    constructor() {
      // Always call super first in constructor
      super();
  
      // Create a shadow root
      const shadow = this.attachShadow({mode: 'open'});
  
      // Create spans
  
      const wrapper = document.createElement('div');
      wrapper.setAttribute('class', 'wrapper');
  
      const labelField=document.createElement('label');
      const input=document.createElement('input');
      if(this.hasAttribute('inputclass')){
        input.setAttribute('class',this.getAttribute('inputclass'));
      }
  
      if(this.hasAttribute('getInput')) {
        input.type = this.getAttribute('getInput');
      } else {
        input.type = 'text';
      }
  
      if(this.hasAttribute('name')) {
        input.name = this.getAttribute('name');
      } else {
        input.name = 'sample';
      }
  
      if(this.hasAttribute('iid')) {
        input.id = this.getAttribute('iid');
      } else {
        input.id = 'sample';
      }
  
      if(this.hasAttribute('label')) {
          labelField.innerHTML = this.getAttribute('label');
      } else {
          labelField.innerHTML = 'Enter the input...';
      }
  
      if(this.hasAttribute('Tooltip')){
           input.title = this.getAttribute('label');
      } else {
          input.title = 'Sample Input Field...';
      }
  
      this.input=input;
      labelField.setAttribute("for",input.id);
      var br = document.createElement("br");
      this.labelField=labelField;
     
      // Create some CSS to apply to the shadow dom
      const style = document.createElement('style');
      // console.log(style.isConnected);
  
      style.textContent = `
      .wrapper {
          margin: 5px;
          padding: 7px;
          position:relative;
      }
      .cust-input {
          margin-top: 7px;
          width: 387px;
          height: 30px;
      }`;
  
      // Attach the created elements to the shadow dom
      shadow.appendChild(style);
      
      shadow.appendChild(wrapper);
      wrapper.appendChild(labelField);
      wrapper.appendChild(br);
      wrapper.appendChild(input);
    }
  
    // A getter/setter for a disabled property.
    get getInput() {
      return this.hasAttribute('getInput');
    }
  
    set getInput(val) {
      // Reflect the value of the disabled property as an HTML attribute.
      if (val) {
        this.input.type=val;
      } else {
        this.input.type="text";
      }
    }
  
    get label(){
      return this.hasAttribute('label');
    }
  
    set label(val){
      if(val){
          // console.log(val.innerHTML);
          this.labelField.innerHTML=val;
      }else{
          this.labelField.innerHTML="Enter the value..";
      }
    }
  
    get iid(){
      return this.hasAttribute('iid');
    }
    set iid(val){
      if(val){
          this.input.id=val;
      }
      else{
          this.input.id="sample";
      }
    }
  
    get inputclass(){
        return this.hasAttribute('inputclass');
    }
    set inputclass(val){
        if(val){
            input.setAttribute('class',val);
            // this.input.class=val;
        }else{
            // this.input.class="";
            input.setAttribute('class',"");

        }
    }
    get name(){
      return this.hasAttribute('name');
    }
    set name(val){
      if(val){
          this.input.name=val;
      }
      else{
          this.input.name="sample";
      }
    }
  
    get Tooltip(){
      return this.hasAttribute('Tooltip');
    }
    set Tooltip(val){
      if(val){
          this.input.title=val;
      }
      else{
          this.input.title="sample";
      }
    }
  
     connectedCallback() {
          console.log('Custom square element added to page.');
      }
  
      disconnectedCallback() {
       console.log('Custom square element removed from page.');
      }
  
      adoptedCallback() {
          console.log('Custom square element moved to new page.');
      }
  
      attributeChangedCallback(name, oldValue, newValue) {
          console.log('Custom square element attributes changed.');
      }
  
      static get observedAttributes() { return ['iid', 'name','Tooltip','label','getInput']; }
  
  }
  
  // Define the new element
  customElements.define('form-input', formInput);