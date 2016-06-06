// Copyright 2015 Google Inc. All rights reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


/**
 * @constuctor AccountSummaries
 *
 * Takes an array of accounts and writes the following new properties:
 * `accounts_`, `webProperties_`, `profiles_`, `accountsById_`,
 * `webPropertiesById_`, and `profilesById_`.
 * Each of the ___ById properties contains an array of objects where the
 * key is the entity ID and the value is an object containing the entity and
 * the entity's parents. For example, an object in the `profilesById_` array
 * might look like this:
 *     {
 *       "1234": {
 *         self: {...},
 *         parent: {...},
 *         grandParent: {...}
 *       }
 *     }
 *
 * It also aliases the properties `webProperties` to `properties` and
 * `profiles` to `views` within the `accounts` array tree.

 * @param {Array} accounts A list of accounts in the format returned by the
 *     management API's accountSummaries#list method.
 * @returns {AccountSummaries}
 */
function AccountSummaries(accounts) {

  this.accounts_ = accounts;
  this.webProperties_ = [];
  this.profiles_ = [];

  this.accountsById_ = {};
  this.webPropertiesById_ = this.propertiesById_ = {};
  this.profilesById_ = this.viewsById_ = {};

  for (var i = 0, account; account = this.accounts_[i]; i++) {

    this.accountsById_[account.id] = {
      self: account
    };

    if (!account.webProperties) continue;

    // Add aliases.
    alias(account, 'webProperties', 'properties');

    for (var j = 0, webProperty; webProperty = account.webProperties[j]; j++) {

      this.webProperties_.push(webProperty);
      this.webPropertiesById_[webProperty.id] = {
        self: webProperty,
        parent: account
      };

      if (!webProperty.profiles) continue;

      // Add aliases.
      alias(webProperty, 'profiles', 'views');

      for (var k = 0, profile; profile = webProperty.profiles[k]; k++) {

        this.profiles_.push(profile);
        this.profilesById_[profile.id] = {
          self: profile,
          parent: webProperty,
          grandParent: account
        };
      }
    }
  }
}


/**
 * Return a list of all accounts this user has access to.
 * Since the accounts contain the web properties and the web properties contain
 * the profiles, this list contains everything.
 * @return {Array}
 */
AccountSummaries.prototype.all = function() {
  return this.accounts_;
};

alias(AccountSummaries.prototype, 'all',
                                  'allAccounts');


/**
 * Return a list of all web properties this user has access to.
 * @return {Array}
 */
AccountSummaries.prototype.allWebProperties = function() {
  return this.webProperties_;
};

alias(AccountSummaries.prototype, 'allWebProperties',
                                  'allProperties');


/**
 * Return a list of all profiles this user has access to.
 * @return {Array}
 */
AccountSummaries.prototype.allProfiles = function() {
  return this.profiles_;
};

alias(AccountSummaries.prototype, 'allProfiles',
                                  'allViews');


/**
 * Returns an account, web property or profile given the passed ID in the
 * `idData` object.  The ID data object can contain only one of the
 * following properties: "accountId", "webPropertyId", "propertyId",
 * "profileId", or "viewId".  If more than one key is passed, an error is
 * thrown.
 *
 * @param {Object} obj An object with no more than one of the following
 *     keys: "accountId", "webPropertyId", "propertyId", "profileId" or
 *     "viewId".
 * @return {Object|undefined} The matching account, web property, or
 *     profile. If none are found, undefined is returned.
 */
AccountSummaries.prototype.get = function(obj) {
  if (!!obj.accountId +
      !!obj.webPropertyId +
      !!obj.propertyId +
      !!obj.profileId +
      !!obj.viewId > 1) {

    throw new Error('get() only accepts an object with a single ' +
        'property: either "accountId", "webPropertyId", "propertyId", ' +
        '"profileId" or "viewId"');
  }
  return this.getProfile(obj.profileId || obj.viewId) ||
      this.getWebProperty(obj.webPropertyId || obj.propertyId) ||
      this.getAccount(obj.accountId);
};


/**
 * Get an account given its ID.
 * @param {string|number} accountId
 * @return {Object} The account with the given ID.
 */
AccountSummaries.prototype.getAccount = function(accountId) {
  return this.accountsById_[accountId] &&
      this.accountsById_[accountId].self;
};


/**
 * Get a web property given its ID.
 * @param {string} webPropertyId
 * @return {Object} The web property with the given ID.
 */
AccountSummaries.prototype.getWebProperty = function(webPropertyId) {
  return this.webPropertiesById_[webPropertyId] &&
      this.webPropertiesById_[webPropertyId].self;
};

alias(AccountSummaries.prototype, 'getWebProperty',
                                  'getProperty');


/**
 * Get a profile given its ID.
 * @param {string|number} profileId
 * @return {Object} The profile with the given ID.
 */
AccountSummaries.prototype.getProfile = function(profileId) {
  return this.profilesById_[profileId] &&
      this.profilesById_[profileId].self;
};

alias(AccountSummaries.prototype, 'getProfile',
                                  'getView');


/**
 * Get an account given the ID of one of its profiles.
 * @param {string|number} profileId
 * @return {Object} The account containing this profile.
 */
AccountSummaries.prototype.getAccountByProfileId = function(profileId) {
  return this.profilesById_[profileId] &&
      this.profilesById_[profileId].grandParent;
};


alias(AccountSummaries.prototype, 'getAccountByProfileId',
                                  'getAccountByViewId');



/**
 * Get a web property given the ID of one of its profile.
 * @param {string|number} profileId
 * @return {Object} The web property containing this profile.
 */
AccountSummaries.prototype.getWebPropertyByProfileId = function(profileId) {
  return this.profilesById_[profileId] &&
      this.profilesById_[profileId].parent;
};

alias(AccountSummaries.prototype, 'getWebPropertyByProfileId',
                                  'getPropertyByViewId');


/**
 * Get an account given the ID of one of its web properties.
 * @param {string|number} webPropertyId
 * @return {Object} The account containing this web property.
 */
AccountSummaries.prototype.getAccountByWebPropertyId = function(webPropertyId) {
  return this.webPropertiesById_[webPropertyId] &&
      this.webPropertiesById_[webPropertyId].parent;
};

alias(AccountSummaries.prototype, 'getAccountByWebPropertyId',
                                  'getAccountByPropertyId');


/**
 * Alias a property of an object using es5 getters. If es5 getters are not
 * supported, just add the aliased property directly to the object.
 * @param {Object} object The object for which you want to alias properties.
 * @param {string} referenceProp The reference property.
 * @param {string} aliasName The reference property's alias name.
 */
function alias(object, referenceProp, aliasName) {
  if (Object.defineProperty) {
    Object.defineProperty(object, aliasName, {
      get: function() {
        return object[referenceProp];
      }
    });
  }
  else {
    object[aliasName] = object[referenceProp];
  }
}


module.exports = AccountSummaries;
