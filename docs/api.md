#  API

## 列表

* 获取已登录用户信息：GET /api/getUser **【需要已登录】**
* 首页列表的无限滚动：GET /api/getMoreBottles[?id=xxx] **【id 不写则默认为 9999999】**
* 获取某个瓶子的信息：GET /api/getBottle?id=xxx
* 获取某个瓶子的回复：GET /api/getComments?id=xxx
* 获取我的瓶子的列表：GET /api/getMyBottles[?id=xxx] **【id 不写则默认为 9999999】**
* 给某个瓶子点赞：GET /api/getLike?id=xxx **【需要已登录】**
* 获取自己的未读消息 GET　/api/getMessage  **【需要已登录】**
* 扔一个新瓶子：POST /api/postBottle，{ content, secret, gender } **【需要已登录】**
* 回复一个瓶子：POST /api/postComment，{ postId, content, secret, gender } **【需要已登录】**
* 获取包含某个话题的瓶子:  GET /api/getTopic?topic=%s[&id=%d]**【topic 为话题，传纯文字（可能出问题）；id 默认 9999999】**

## QQ 空间分享 API（暂时无法使用）

https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={完整的地址列表}&title={标题}&desc={要发送的动态的文字}&summary={内容摘要}&site={显示的来源}&pics={完整的图片地址}
