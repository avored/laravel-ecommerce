
window.Vue = require('vue')

window.AvoRed = (function() {
    return {
        initialize: function(callback) {
            callback(window.Vue)
        }
    }
})()


window.EventBus = new Vue()

exports = module.exports = AvoRed
