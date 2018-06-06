<template>
    <div class="form-group">
        <label :id=fieldName>{{ label }}</label>
        <input :type="fieldType" 
              :id=fieldName  
              :name=fieldName 
              :value=fieldValue
              :class=fieldClass />
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
        }
    }
</script>