/**
 * SPDX-FileCopyrightText: 2018 John Molakvoæ <skjnldsv@protonmail.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

import { generateFilePath } from '@nextcloud/router'

import Vue from 'vue'
import App from './App.vue'

// eslint-disable-next-line
__webpack_public_path__ = generateFilePath(appName, '', 'js/')

Vue.prototype.OC = window.OC
Vue.prototype.OCA = window.OCA

Vue.mixin({ methods: { t, n } })

export default new Vue({
	el: '#content',
	render: h => h(App),
})
