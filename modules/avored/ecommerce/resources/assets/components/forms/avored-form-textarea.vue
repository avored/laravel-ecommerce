<template>
    <div class="form-group">
        <label :id=fieldName>{{ label }}</label>
        <textarea 
                :id=fieldName  
                :name=fieldName 
                @input="onChange"
                :class=computedClass
                v-model="textFieldValue"
               ></textarea>
        <div   v-show=dataDisplayError   class="invalid-feedback">
            {{ errorText }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            label: { type:String, required: true},
            fieldName: { type:String, required: true},
            fieldClass: { type:String, default: 'form-control'},
            fieldValue: { type:String, default: ''},
            errorText   : { type:String, default: ''},
        },
        computed: {
            computedClass: function() {
                if(this.errorText == ""){
                    return this.fieldClass;
                }
                
                return this.fieldClass + " is-invalid";
            },
            options: function() {
                return JSON.parse(this.fieldOptions);
            }
        },
        data: function () {
            return {
                
                dataDisplayError : function() {   
                    if(this.errorText == ""){
                        return false;
                    } 
                    return true;    
                },
                textFieldValue: this.fieldValue,
            }
        },
        methods:{
            onChange: function(){
                this.$emit('change', event.target.value, this.fieldName);

                if( event.target.value != "") {
                    this.dataDisplayError = false
                }

                this.textFieldValue = event.target.value;
            }
           
        }
    }
</script>