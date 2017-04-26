<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . '/components/com_bliss/media/js/vue.js');
?>
<h1>Vue Playground</h1>

<div id="app">
	<div class="main-box">
        <h3>
            Hello: {{ fullName }}
        </h3>

        <p v-bind:title="getTitleName()">
            Foo
        </p>

        <input type="text" name="firstName" v-model="firstName" />
        <input type="text" name="lastName" v-model="lastName" />
    </div>

    <select name="state" id="state" v-model="state">
        <option value="1">Open</option>
        <option value="0">Close</option>
    </select>

    <button type="button" class="btn" v-on:click="state = 1">State 1</button>
    <button type="button" class="btn" v-on:click="mySubmit()">State 0</button>
</div>

<script>
	var vm = new Vue({
		el: '#app',
		data: {
		    flower: 'sakura',
            myTitle: 'Hello',
            firstName: 'Simon',
            lastName: 'Asika',
            state: 0
		},
        mounted: function  () {
            this.toggleMainBox(this.state);
        },
        methods: {
		    getTitleName: function () {
                return this.myTitle + ' World';
            },
            toggleMainBox: function (value) {
                if (value == 1) {
                    jQuery('.main-box').slideDown();
                } else {
                    jQuery('.main-box').slideUp();
                }
            },
            mySubmit: function () {
                // Validate

                // Check

                if (true) {
                    jQuery('#adminForm').submit();
                } else {
                    // Show error message
                    return false;
                }
            }
        },
        computed: {
		    fullName: function () {
                return this.firstName + ' ' + this.lastName;
            }
        },
        watch: {
		    state: function (value, oldValue) {
		        this.toggleMainBox(value);
            },
            firstName: function (value, oldValue) {
                console.log(value, oldValue);
            }
        }
	});
</script>

