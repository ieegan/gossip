require('./bootstrap');

Vue.component('gossip',require('./components/Gossip.vue'));
Vue.component('gossip-list',require('./components/GossipList.vue'));

class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.errors = {};
    }


    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }


    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }


    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.errors = errors;
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}


class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
    	data = this.originalData;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors.clear();
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
    	this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}


let app = new Vue({
    el: '#app',

    data: {
        form: new Form({
            body: '',
            anonymous: true
        }),
        gossips: {},
        page: 1,
        lastpage: 0,
        lastpagereached: true
    },

    methods: {
        onSubmit() {
            this.form.post('/post-gossip')
                .then(response =>  this.unshiftGossip(response))
                .catch(error => alert('boohoo!'));
        },

        unshiftGossip(data) {
        	this.gossips.unshift(data);
        },

        checkLastPage() {
            if(this.lastpage<=this.page)
                this.fetchGossips()
            else
                this.lastpagereached = false
        },

		fetchGossips() {  
			var self = this;
			axios.post('/show-gossip', {
				page: self.page
			})
			.then(function (response) {
                if(self.page == 1) {
                    self.gossips = response.data.data;
                    self.lastpage = response.data.last_page;
                }
                else{
                    for (let key in response.data.data) {
                        let gossip = response.data.data[key];
                        self.gossips.push(gossip);
                    }
                }
				self.page++
			})
			.catch(function (error) {
				console.log(error);
			});
		}
    }
});

var myElement = document.getElementById("bottom");

var elementWatcher = scrollMonitor.create(myElement);

elementWatcher.enterViewport(function() {
    app.checkLastPage();
});