import AppForm from '../app-components/Form/AppForm';

Vue.component('vendedore-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nome:  '' ,
                email:  '' ,
                
            }
        }
    }

});