export default {
    data() {
        return {
            
        }
    },
    methods: {
        randomString() {
            let random_string = "";
            let random_ascii;
            for (let i = 0; i < 6; i++) {
              random_ascii = Math.floor(Math.random() * 25 + 97);
              random_string += String.fromCharCode(random_ascii);
            }
            return random_string;
        },
    }
}
