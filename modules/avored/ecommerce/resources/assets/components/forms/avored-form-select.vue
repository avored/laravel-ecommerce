<template>
    <div class="form-group">
        <label :id=fieldName>{{ label }}</label>
        <select 
              :id=fieldName  
              :name=fieldName 
              @input="onChange"
              :class=computedClass
                v-model="selectedValue"
               >

              <option v-for="option in options"   :key="option.id" :value="option.id">
                  {{ option.name }}

                </option>

        </select>
        <div   v-show=dataDisplayError   class="invalid-feedback">
            {{ errorText }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            fieldOptions: { type:String, default: '' },
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
                selectedValue: function() {
                    return this.fieldValue;
                }
            }
        },
        methods:{
            onChange: function(){
                this.$emit('change', event.target.value, this.fieldName);

                if( event.target.value != "") {
                    this.dataDisplayError = false
                }

                this.selectValue = event.target.value;
            },
            isSelected: function(option) {
                console.info(option.id, this.fieldValue);
                console.info(option.id == this.fieldValue);
                return (option.id == this.fieldValue);
            }
        }
    }
</script>