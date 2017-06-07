
1. Delete the replace: false option and instead wrap your root component with an element similar to the one you're replacing, e.g. el: '#app' with template: '<div id="app"> ... </div>'
  Line 13: /Users/zhudi/Code/php/im/resources/assets/js/App.vue
  Reason: The replace option has been removed, as it provides too little convenience
  More info: http://vuejs.org/guide/migration.html#replace-false

`2. Replace v-link="{name:'category'}" with the new <router-link> component (see link below for details)
  Line 8: /Users/zhudi/Code/php/im/resources/assets/js/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

`3. Replace v-link="{name:'cart'}" with the new <router-link> component (see link below for details)
  Line 12: /Users/zhudi/Code/php/im/resources/assets/js/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

`4. Replace v-link="{name:'usercenter'}" with the new <router-link> component (see link below for details)
  Line 18: /Users/zhudi/Code/php/im/resources/assets/js/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

`5. Replace :value.sync="form_data.name" with :value="form_data.name", then $emit an event from the child component to trigger an update to form_data.name in the parent
  Line 5: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressAdd.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

`6. Replace :value.sync="form_data.phone" with :value="form_data.phone", then $emit an event from the child component to trigger an update to form_data.phone in the parent
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressAdd.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

7. Replace :value.sync="form_data.address" with :value="form_data.address", then $emit an event from the child component to trigger an update to form_data.address in the parent
  Line 22: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressAdd.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

8. Replace :value.sync="form_data.defaulted" with :value="form_data.defaulted", then $emit an event from the child component to trigger an update to form_data.defaulted in the parent
  Line 27: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressAdd.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

9. Replace ready with mounted, then use Vue.nextTick if you need an in-document guarantee
  Line 59: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressAdd.vue
  Reason: ready lifecycle hook has been removed
  More info: http://vuejs.org/guide/migration.html#ready

10. Replace v-link="{name:'add-address'}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressChoose.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

11. Replace v-link="{name:'edit-address',params:{'hashid':address.id}}" with the new <router-link> component (see link below for details)
  Line 18: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressChoose.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

12. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 47: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressChoose.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

13. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 52: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressChoose.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

14. Replace :value.sync="address.name" with :value="address.name", then $emit an event from the child component to trigger an update to address.name in the parent
  Line 5: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressEdit.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

15. Replace :value.sync="address.phone" with :value="address.phone", then $emit an event from the child component to trigger an update to address.phone in the parent
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressEdit.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

16. Replace :value.sync="address.address" with :value="address.address", then $emit an event from the child component to trigger an update to address.address in the parent
  Line 22: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressEdit.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

17. Replace :value.sync="address.defaulted" with :value="address.defaulted", then $emit an event from the child component to trigger an update to address.defaulted in the parent
  Line 27: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressEdit.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

18. Replace v-link="{name:'add-address'}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

19. Replace v-link="{name:'edit-address',params:{'hashid':address.id}}" with the new <router-link> component (see link below for details)
  Line 10: /Users/zhudi/Code/php/im/resources/assets/js/components/Address/AddressList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

20. Replace :is-show.sync="empty" with :is-show="empty", then $emit an event from the child component to trigger an update to empty in the parent
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Category.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

21. Replace :list.sync="data" with :list="data", then $emit an event from the child component to trigger an update to data in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Category.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

22. Replace :is-show.sync="empty" with :is-show="empty", then $emit an event from the child component to trigger an update to empty in the parent
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Plate.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

23. Replace :list.sync="data" with :list="data", then $emit an event from the child component to trigger an update to data in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Plate.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

24. Replace v-link="{name:'aCategory',params:{'hashid':sub_category.id}}" with the new <router-link> component (see link below for details)
  Line 13: /Users/zhudi/Code/php/im/resources/assets/js/components/Category.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

25. Replace :is-show.sync="empty" with :is-show="empty", then $emit an event from the child component to trigger an update to empty in the parent
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Topic.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

26. Replace :list.sync="data" with :list="data", then $emit an event from the child component to trigger an update to data in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Attribute/Topic.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

27. Replace v-link="{name:'commodity',params:{hashid:cart.commodity.id}}" with the new <router-link> component (see link below for details)
  Line 7: /Users/zhudi/Code/php/im/resources/assets/js/components/Cart.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

28. Update value="{{cart.commodity_num}}" to v-bind:value="cart.commodity_num"
  Line 20: /Users/zhudi/Code/php/im/resources/assets/js/components/Cart.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

29. Replace v-link="{name:'index'}" with the new <router-link> component (see link below for details)
  Line 50: /Users/zhudi/Code/php/im/resources/assets/js/components/Cart.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

30. Replace ready with mounted, then use Vue.nextTick if you need an in-document guarantee
  Line 69: /Users/zhudi/Code/php/im/resources/assets/js/components/Cart.vue
  Reason: ready lifecycle hook has been removed
  More info: http://vuejs.org/guide/migration.html#ready

31. Replace router.go with router.push
  Line 170: /Users/zhudi/Code/php/im/resources/assets/js/components/Cart.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

32. Replace v-link="{name:'category'}" with the new <router-link> component (see link below for details)
  Line 7: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityEmpty.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

33. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 17: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityEmpty.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

34. Replace {{{commodity.commodity_detail_info}}} with v-html="commodity.commodity_detail_info" on a containing element
  Line 35: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityDetail.vue
  Reason: HTML interpolation with {{{ }}} has been removed
  More info: http://vuejs.org/guide/migration.html#HTML-Interpolation

35. Replace {{{commodity.commodity_base_info | rnTransform}}} with v-html="commodity.commodity_base_info | rnTransform" on a containing element
  Line 38: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityDetail.vue
  Reason: HTML interpolation with {{{ }}} has been removed
  More info: http://vuejs.org/guide/migration.html#HTML-Interpolation

36. Replace v-link="{name:'cart'}" with the new <router-link> component (see link below for details)
  Line 43: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityDetail.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

37. Replace router.go with router.push
  Line 100: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityDetail.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

38. Replace router.go with router.push
  Line 142: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityDetail.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

39. Replace v-link="{name:'commodity',params:{hashid:item.id}}" with the new <router-link> component (see link below for details)
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

40. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 24: /Users/zhudi/Code/php/im/resources/assets/js/components/Commodity/CommodityList.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

41. Update href="{{banner.redirect_url}}" to v-bind:href="banner.redirect_url"
  Line 5: /Users/zhudi/Code/php/im/resources/assets/js/components/Index/IndexBanner.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

42. Update id="{{topic.topic_title}}" to v-bind:id="topic.topic_title"
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Index/IndexTopic.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

43. Replace v-link="{name:'aTopic',params:{'hashid':topic.id}}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/components/Index/IndexTopic.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

44. Replace v-link="{name:'aPlate',params:{'hashid':plate.id}}" with the new <router-link> component (see link below for details)
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Index/IndexPlate.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

45. Replace :selected.sync="order_type" with :selected="order_type", then $emit an event from the child component to trigger an update to order_type in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

46. Replace v-link="{name:'order-list',params:{'type':'all'}}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

47. Replace v-link="{name:'order-list',params:{'type':'unpay'}}" with the new <router-link> component (see link below for details)
  Line 5: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

48. Replace v-link="{name:'order-list',params:{'type':'unreceived'}}" with the new <router-link> component (see link below for details)
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

49. Replace v-link="{name:'order-detail',params:{'hashid':order.id}}" with the new <router-link> component (see link below for details)
  Line 11: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

50. Update alt="{{detail.commodity_name}}" to v-bind:alt="detail.commodity_name"
  Line 18: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

51. Remove the canReuse option
  Line 60: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderList.vue
  Reason: There's no longer a use case for canReuse in the new Vue Router
  More info: http://vuejs.org/guide/migration-vue-router.html#canReuse-false

52. Replace v-link="{name:'commodity',params:{'hashid':detail.commodity_id}}" with the new <router-link> component (see link below for details)
  Line 32: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderDetail.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

53. Update alt="{{detail.commodity_name}}" to v-bind:alt="detail.commodity_name"
  Line 33: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderDetail.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

54. Replace :value.sync="suggestion" with :value="suggestion", then $emit an event from the child component to trigger an update to suggestion in the parent
  Line 10: /Users/zhudi/Code/php/im/resources/assets/js/components/Suggestion/Suggestion.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

55. Replace router.go with router.push
  Line 51: /Users/zhudi/Code/php/im/resources/assets/js/components/Suggestion/Suggestion.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

56. Replace v-link="{name:'add-address'}" with the new <router-link> component (see link below for details)
  Line 16: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderSettle.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

57. Replace :choosed.sync="address" with :choosed="address", then $emit an event from the child component to trigger an update to address in the parent
  Line 59: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderSettle.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

58. Replace :visible.sync="choosing" with :visible="choosing", then $emit an event from the child component to trigger an update to choosing in the parent
  Line 60: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderSettle.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

59. Replace router.go with router.push
  Line 104: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderSettle.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

60. Replace router.go with router.push
  Line 182: /Users/zhudi/Code/php/im/resources/assets/js/components/Order/OrderSettle.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

61. Replace v-link="{name:'order-list',params:{'type':'all'}}" with the new <router-link> component (see link below for details)
  Line 8: /Users/zhudi/Code/php/im/resources/assets/js/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

62. Replace v-link="{name:'order-list',params:{'type':'unpay'}}" with the new <router-link> component (see link below for details)
  Line 11: /Users/zhudi/Code/php/im/resources/assets/js/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

63. Replace v-link="{name:'order-list',params:{'type':'unreceived'}}" with the new <router-link> component (see link below for details)
  Line 14: /Users/zhudi/Code/php/im/resources/assets/js/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

64. Replace v-link="{name:'address'}" with the new <router-link> component (see link below for details)
  Line 19: /Users/zhudi/Code/php/im/resources/assets/js/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

65. Replace v-link="{name:'suggestion'}" with the new <router-link> component (see link below for details)
  Line 24: /Users/zhudi/Code/php/im/resources/assets/js/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

66. Delete the replace: false option and instead wrap your root component with an element similar to the one you're replacing, e.g. el: '#app' with template: '<div id="app"> ... </div>'
  Line 16: /Users/zhudi/Code/php/im/resources/assets/js/event/App.vue
  Reason: The replace option has been removed, as it provides too little convenience
  More info: http://vuejs.org/guide/migration.html#replace-false

67. Replace :selected.sync="selected" with :selected="selected", then $emit an event from the child component to trigger an update to selected in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/_layouts/Navbar.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

68. Replace v-link="{name:'aOpen'}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/event/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

69. Replace v-link="{name:'aClose'}" with the new <router-link> component (see link below for details)
  Line 8: /Users/zhudi/Code/php/im/resources/assets/js/event/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

70. Replace v-link="{name:'cart'}" with the new <router-link> component (see link below for details)
  Line 12: /Users/zhudi/Code/php/im/resources/assets/js/event/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

71. Replace v-link="{name:'usercenter'}" with the new <router-link> component (see link below for details)
  Line 18: /Users/zhudi/Code/php/im/resources/assets/js/event/components/_layouts/Navbar.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

72. Replace :is-show.sync="empty" with :is-show="empty", then $emit an event from the child component to trigger an update to empty in the parent
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Attribute/Close.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

73. Replace :list.sync="data" with :list="data", then $emit an event from the child component to trigger an update to data in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Attribute/Close.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

74. Replace :is-show.sync="empty" with :is-show="empty", then $emit an event from the child component to trigger an update to empty in the parent
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Attribute/Open.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

75. Replace :list.sync="data" with :list="data", then $emit an event from the child component to trigger an update to data in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Attribute/Open.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

76. Replace v-link="{name:'commodity',params:{hashid:cart.commodity.id}}" with the new <router-link> component (see link below for details)
  Line 7: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Cart.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

77. Update value="{{cart.commodity_num}}" to v-bind:value="cart.commodity_num"
  Line 20: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Cart.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

78. Replace v-link="{name:'index'}" with the new <router-link> component (see link below for details)
  Line 50: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Cart.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

79. Replace ready with mounted, then use Vue.nextTick if you need an in-document guarantee
  Line 69: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Cart.vue
  Reason: ready lifecycle hook has been removed
  More info: http://vuejs.org/guide/migration.html#ready

80. Replace router.go with router.push
  Line 171: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Cart.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

81. Replace v-link="{name:'commodity',params:{hashid:item.id}}" with the new <router-link> component (see link below for details)
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityCloseList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

82. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 23: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityCloseList.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

83. Replace v-link="{name:'aCategory',params:{'hashid':sub_category.id}}" with the new <router-link> component (see link below for details)
  Line 13: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Category.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

84. Replace v-link="{name:'category'}" with the new <router-link> component (see link below for details)
  Line 7: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityEmpty.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

85. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 17: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityEmpty.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

86. Replace {{{commodity.event_detail_info}}} with v-html="commodity.event_detail_info" on a containing element
  Line 41: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityDetail.vue
  Reason: HTML interpolation with {{{ }}} has been removed
  More info: http://vuejs.org/guide/migration.html#HTML-Interpolation

87. Replace {{{commodity.event_base_info | rnTransform}}} with v-html="commodity.event_base_info | rnTransform" on a containing element
  Line 44: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityDetail.vue
  Reason: HTML interpolation with {{{ }}} has been removed
  More info: http://vuejs.org/guide/migration.html#HTML-Interpolation

88. Replace v-link="{name:'cart'}" with the new <router-link> component (see link below for details)
  Line 49: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityDetail.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

89. Replace router.go with router.push
  Line 108: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityDetail.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

90. Replace router.go with router.push
  Line 151: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityDetail.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

91. Replace v-link="{name:'commodity',params:{hashid:item.id}}" with the new <router-link> component (see link below for details)
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

92. Delete twoWay: true, then $emit an event from the child component to trigger an update to the prop in the parent
  Line 30: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Commodity/CommodityList.vue
  Reason: Two-way prop binding has been removed in favor of more explicit event-driven communication between parent and child
  More info: http://vuejs.org/guide/migration.html#twoWay-Prop-Option

93. Replace v-link="{name:'commodity',params:{'hashid':detail.commodity_id}}" with the new <router-link> component (see link below for details)
  Line 33: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderDetail.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

94. Update alt="{{detail.commodity_name}}" to v-bind:alt="detail.commodity_name"
  Line 34: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderDetail.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

95. Replace :selected.sync="order_type" with :selected="order_type", then $emit an event from the child component to trigger an update to order_type in the parent
  Line 3: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

96. Replace v-link="{name:'order-list',params:{'type':'all'}}" with the new <router-link> component (see link below for details)
  Line 4: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

97. Replace v-link="{name:'order-list',params:{'type':'unpay'}}" with the new <router-link> component (see link below for details)
  Line 5: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

98. Replace v-link="{name:'order-list',params:{'type':'unreceived'}}" with the new <router-link> component (see link below for details)
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

99. Replace v-link="{name:'order-detail',params:{'hashid':order.id}}" with the new <router-link> component (see link below for details)
  Line 11: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

100. Update alt="{{detail.commodity_name}}" to v-bind:alt="detail.commodity_name"
  Line 19: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: Interpolation within attributes has been removed
  More info: http://vuejs.org/guide/migration.html#Interpolation-within-Attributes

101. Remove the canReuse option
  Line 61: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderList.vue
  Reason: There's no longer a use case for canReuse in the new Vue Router
  More info: http://vuejs.org/guide/migration-vue-router.html#canReuse-false

102. Replace v-link="{name:'add-address'}" with the new <router-link> component (see link below for details)
  Line 17: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderSettle.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

103. Replace :choosed.sync="address" with :choosed="address", then $emit an event from the child component to trigger an update to address in the parent
  Line 62: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderSettle.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

104. Replace :visible.sync="choosing" with :visible="choosing", then $emit an event from the child component to trigger an update to choosing in the parent
  Line 63: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderSettle.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

105. Replace router.go with router.push
  Line 108: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderSettle.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

106. Replace router.go with router.push
  Line 193: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Order/OrderSettle.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

107. Replace v-link="{name:'order-list',params:{'type':'all'}}" with the new <router-link> component (see link below for details)
  Line 8: /Users/zhudi/Code/php/im/resources/assets/js/event/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

108. Replace v-link="{name:'order-list',params:{'type':'unpay'}}" with the new <router-link> component (see link below for details)
  Line 11: /Users/zhudi/Code/php/im/resources/assets/js/event/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

109. Replace v-link="{name:'order-list',params:{'type':'unreceived'}}" with the new <router-link> component (see link below for details)
  Line 14: /Users/zhudi/Code/php/im/resources/assets/js/event/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

110. Replace v-link="{name:'address'}" with the new <router-link> component (see link below for details)
  Line 20: /Users/zhudi/Code/php/im/resources/assets/js/event/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

111. Replace v-link="{name:'suggestion'}" with the new <router-link> component (see link below for details)
  Line 25: /Users/zhudi/Code/php/im/resources/assets/js/event/components/UserCenter.vue
  Reason: The v-link directive has been replaced with the new <router-link> component
  More info: http://vuejs.org/guide/migration-vue-router.html#v-link

112. Replace :value.sync="suggestion" with :value="suggestion", then $emit an event from the child component to trigger an update to suggestion in the parent
  Line 10: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Suggestion/Suggestion.vue
  Reason: v-bind.sync and v-bind.once have removed to enforce one-way down props, leaving side effects to more explicit component events
  More info: http://vuejs.org/guide/migration.html#v-bind-with-once-and-sync-Modifiers

113. Replace router.go with router.push
  Line 51: /Users/zhudi/Code/php/im/resources/assets/js/event/components/Suggestion/Suggestion.vue
  Reason: For consistency with the HTML5 History API, router.go is now only used for back/forward navigation, while router.push is used to navigate to a specific page
  More info: http://vuejs.org/guide/migration-vue-router.html#router-go

114. Check Vue.directive('data-scroll') to make sure its syntax has been updated and for anything beyond simple DOM manipulations, refactor to a component
  Line 41: /Users/zhudi/Code/php/im/resources/assets/js/event/main.js
  Reason: Directives have been vastly reduced in scope and components are preferred in most use cases
  More info: http://vuejs.org/guide/migration.html#Custom-Directives

115. Replace router.start with router: router on your root Vue instance (see link below for details)
  Line 79: /Users/zhudi/Code/php/im/resources/assets/js/event/main.js
  Reason: Starting an app with routing no longer requires a special method - the router can simply be passed to the root Vue instance as option
  More info: http://vuejs.org/guide/migration-vue-router.html#router-start

116. Check Vue.directive('data-scroll') to make sure its syntax has been updated and for anything beyond simple DOM manipulations, refactor to a component
  Line 34: /Users/zhudi/Code/php/im/resources/assets/js/main.js
  Reason: Directives have been vastly reduced in scope and components are preferred in most use cases
  More info: http://vuejs.org/guide/migration.html#Custom-Directives

117. Replace router.start with router: router on your root Vue instance (see link below for details)
  Line 72: /Users/zhudi/Code/php/im/resources/assets/js/main.js
  Reason: Starting an app with routing no longer requires a special method - the router can simply be passed to the root Vue instance as option
  More info: http://vuejs.org/guide/migration-vue-router.html#router-start

118. Replace router.redirect with a redirect option in a route definition (see link below for details)
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/event/router.js
  Reason: Redirects have been moved to an option on route definitions to improve config organization
  More info: http://vuejs.org/guide/migration-vue-router.html#router-redirect

119. Replace router.map with an array on the new routes option (see link below for details)
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/event/router.js
  Reason: Routes are now defined as an array on a routes option at router instantiation
  More info: http://vuejs.org/guide/migration-vue-router.html#router-map

120. Replace subRoutes with children and update its routes to the new array syntax
  Line 32: /Users/zhudi/Code/php/im/resources/assets/js/event/router.js
  Reason: subRoutes has been renamed to children for consistency within Vue and with other routing libraries
  More info: http://vuejs.org/guide/migration-vue-router.html#subRoutes

121. Replace subRoutes with children and update its routes to the new array syntax
  Line 47: /Users/zhudi/Code/php/im/resources/assets/js/event/router.js
  Reason: subRoutes has been renamed to children for consistency within Vue and with other routing libraries
  More info: http://vuejs.org/guide/migration-vue-router.html#subRoutes

122. Replace router.redirect with a redirect option in a route definition (see link below for details)
  Line 2: /Users/zhudi/Code/php/im/resources/assets/js/router.js
  Reason: Redirects have been moved to an option on route definitions to improve config organization
  More info: http://vuejs.org/guide/migration-vue-router.html#router-redirect

123. Replace router.map with an array on the new routes option (see link below for details)
  Line 6: /Users/zhudi/Code/php/im/resources/assets/js/router.js
  Reason: Routes are now defined as an array on a routes option at router instantiation
  More info: http://vuejs.org/guide/migration-vue-router.html#router-map

124. Replace subRoutes with children and update its routes to the new array syntax
  Line 30: /Users/zhudi/Code/php/im/resources/assets/js/router.js
  Reason: subRoutes has been renamed to children for consistency within Vue and with other routing libraries
  More info: http://vuejs.org/guide/migration-vue-router.html#subRoutes
