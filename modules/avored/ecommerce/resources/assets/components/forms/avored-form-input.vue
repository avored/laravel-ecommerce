<template>
    <div class="form-group">
        <label :id=fieldName>{{ label }}</label>
        <input :type=fieldType
              :id=fieldName  
              :name=fieldName 
              :autofocus=autofocus
              :disabled=disabled
              @input="onChange"
              v-model="value"
              :class=computedClass />
        <div   v-if=dataDisplayError   class="invalid-feedback">
            {{ errorText }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            fieldType:  { type:String,   default: 'text'},
            label:      { type:String,   required: true},
            fieldName:  { type:String,   required: true},
            fieldClass: { type:String,   default: 'form-control'},
            fieldValue: { type:String,   default: ''},
            errorText : { type:String,   default: ''},
            autofocus : { type:Boolean,  default: false},
            disabled :  { type:Boolean,  default: false},

        },
        computed: {
            computedClass: function() {
                if(this.errorText == ""){
                    return this.fieldClass;
                }
                
                return this.fieldClass + " is-invalid";
            }
        },
        data: function () {
            return {
                value: this.fieldValue,
                dataDisplayError : function() {   
                    if(this.errorText == ""){
                        return false;
                    } 
                    return true;    
                }
            }
        },
        methods:{
            onChange: function(){
                this.$emit('change', event.target.value, this.fieldName);

                if( event.target.value != "") {
                    this.dataDisplayError = false
                }

                this.value = event.target.value;
            }
        }
    }
</script>