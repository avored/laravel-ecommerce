<template>
    <div class="form-group">
        <label :id=fieldName>{{ label }}</label>
        <input :type="fieldType" 
              :id=fieldName  
              :name=fieldName 
              @input="onChange"
              :value=fieldValue
              :class=computedClass />
        <div   v-show=displayError   class="invalid-feedback">
            {{ errorText }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            fieldType:{ type:String, default: 'text'},
            label:{ type:String, required: true},
            fieldName:{ type:String, required: true},
            fieldClass:{ type:String, default: 'form-control'},
            fieldValue:{ type:String, default: ''},
            errorText:{ type:String, default: ''},
        },
        computed: {
            displayError: function() {
                    
                if(this.errorText == ""){
                    return false;
                }
                
                return true;    
            },
            computedClass: function() {
                if(this.errorText == ""){
                    return this.fieldClass;
                }
                
                return this.fieldClass + " is-invalid";
            }
        },
        methods:{
            onChange: function(){
                this.$emit('change', event.target.value, this.fieldName)
            }
        }
    }
</script>