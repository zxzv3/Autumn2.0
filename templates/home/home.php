	<link rel="stylesheet" type="text/css" href="./assets/css/home/page/home.css">
</head>
<body>
	<?php $this->load->view(HOME_TEMPLATE . '/template/top-header')?>
	<?php $this->load->view(HOME_TEMPLATE . '/template/menu')?>
	<div class="warpper">

<table class="Index_card">
          <tbody><tr>
            <td style="width:65px;"><div class="em"></div></td>
            <td width="32%">
                <div class="Contact">
                    <dl class="overflow-visible">
                        <dt class="overflow-visible">
                            <div id="ctl00_ContentPlaceHolder1_nameclass" class="Ti auth-state-pass-personal">
                                <span class="abbr">
                                    <span class="color_fei">Hi, <?=$_SESSION['user']['username']?></span>
                                    <span class="color_shenn"></span>

                                    <span class="auth-show">
                                      <span class="auth-icon auth-icon-v">
                                        <span class="auth-tip">
                                          <span class="auth-tip-content">
                                            <span class="auth-tip-ok"><a href="/user/verify/" title="您还没有进行实名认证">立即认证！</a></span>
                                          </span>
                                          <span class="auth-tip-corner"><span class="auth-tip-corner-inner"></span></span>
                                        </span>
                                        <a href="/user/realname/" class="auth-icon-v-link" title="已认证，认证类型：个人"></a>
                                      </span>
                                     
                            </span>
                            <span class="auth-btn"><a href="/user/realname/" class="Annkeld">立即认证</a></span>
                            </span></div>
                            <div class="Bz"><span class="ju">认证邮箱:&nbsp;<span class="color_ju"><?=@$_SESSION['user']['email']?></span>&nbsp;&nbsp;&nbsp;<span class="ju">商户ID:&nbsp;&nbsp;&nbsp;<span class="color_ju"><?=$_SESSION['user']['id']?></span></span></span></div>
                        </dt>
                        <dd>
                            <ul class="aul">
                                <li>安全手机：<span id="ctl00_ContentPlaceHolder1_classshouji" class="color_ju">已绑定</span><a href="/user/mobile/" id="ctl00_ContentPlaceHolder1_linshouji" class="btn fezicms Mleft20 color_tiann" style="padding:2px 11px;margin-left: 10px;">修改</a></li>
                                <li class="a">安全邮箱：<span id="ctl00_ContentPlaceHolder1_classemail" class="color_ju">已绑定</span><a href="/user/email/" id="ctl00_ContentPlaceHolder1_linemail" class="btn fezicms Mleft20 color_tiann" style="padding:2px 11px;margin-left: 10px;">修改</a></li>
                               <li class="b">实名认证：<span id="ctl00_ContentPlaceHolder1_shiming" class="color_ju">已认证</span><a href="/user/realname/index.aspx" id="ctl00_ContentPlaceHolder1_shimingtext" class="btn fezicms Mleft20 color_tiann" style="padding:2px 11px;margin-left: 10px;">修改</a></li>
                                <li class="c">提现密码：<span id="ctl00_ContentPlaceHolder1_classtixian" class="color_ju">已设置</span><a href="/user/awalpassword/" id="ctl00_ContentPlaceHolder1_lintixian" class="btn fezicms Mleft20 color_tiann" style="padding:2px 11px;margin-left: 10px;">修改</a></li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </td>
            <td style="width:0.5%;">&nbsp;</td>
            <td style="width:65px;"><div class="em Money"></div></td>

            <td width="32%">
                <div class="Contact">
                    <dl>
                        <dt>
                            <div class="Ti change">
                                <span class="abbr fl" style="font-size: 33px;color:#333">555.00元</span>
                               <button style="float: left;margin-top:3px;margin-left: 14px;padding:10px 14px;" class="btn"><i class="fa fa-money"></i>提 现</button>
                            </div>
                            <div id="ctl00_ContentPlaceHolder1_Span1" class="Bz changea" style="font-size: 14px;margin-top: 4px;">今日总订单数量：0 笔</div>
                        </dt>
                        <dd style="margin-top:24px;">
                            <ul class="bul Mtop20">
                                <li><a href="/user/verify/">提现账户</a></li>
                                <li class="w"><a href="/user/order/">订单管理</a></li>
                            </ul>
                            <div class="Scfdh0"></div>
                            <ul class="bul">
                                <li><a href="/user/money/">收支明细</a></li>
                                <li><a href="/user/cashcoupon/">提现记录</a></li>
                                <li><a href="/user/invoice/">API接入</a></li>
                                <li class="w"><a href="/user/userrate//">商家费率</a></li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </td>

            <td style="width:0.5%;">&nbsp;</td>
            <td style="width:65px;"><div class="em overcome"></div></td>
            <td width="32%">
                
                <div class="Contact">
                    <dl>
                        <dt>
                            <div class="Ti niaoyunicon change">
                                <span class="abbr Pleft50" style="margin-left:50px;">专席客服</span>
                            </div>
                        </dt>
                        <dd>
                            <ul class="cul Pleft50">
                                <li>工号：80037</li>
                                <li>Q Q：<span class="color_tiann">69384331</span></li>
                                <li>电话：</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </td>
          </tr>
          <tr>
            <td colspan="5" valign="top">
                <dl class="dl_1">
                    <dt>
                        <div class="Dt_1">&nbsp;产品与统计信息</div>
                    </dt>
                    <dd>

                        

                        <div class="Dt_0">
                        
                            <div class="Bpwen1 ico7"><span>已绑定银行卡：(3)张</span><a href="/user/verify/">查看</a></div>
                            <div class="Bpwen1 ico8"><span>站内消息未读：(0)条</span><a href="/user/message/">查看</a></div>
                            
                            <div class="Bpwen1 ico1"><span>今日成功订单总数：0笔</span></div>
                            <div class="Bpwen1 ico2"><span>今日成功总金额：0元</span></div>
                            
                            <div class="Bpwen1 ico3"><span>今日网银订单金额：0元</span></div>
                            <div class="Bpwen1 ico4"><span>今日点卡充值金额：0元</span></div>

                            <div class="Bpwen2 ico5"><span>今日微信充值金额：0元</span></div>
                            <div class="Bpwen2 ico6"><span>今日支付宝充值金额：0元</span></div>

                            <div class="Scfdh0"></div>
                        </div>
                    </dd>
                  
                </dl>
            </td>
            <td>&nbsp;</td>
            <td colspan="2" valign="top">

                <dl class="dl_2">
                    <dt>
                        <div class="Dt_1">会员公告</div>
                        <div class="Dt_3"><a href="/news.aspx?id=2" target="_blank" class="color_tiann">更多</a></div>
                    </dt>
                    <dd>
                        <div class="Dt_0">
                            
                                   <div class="Bpwen1"><a href="/newsnotice.aspx?id=77">
                                        支付宝通道维护完毕,请知晓</a>
                                        <span>
                                            04-02</span>
                                    </div>
                                
                                   <div class="Bpwen1"><a href="/newsnotice.aspx?id=75">
                                        接到支付宝官方通知,例行维护,请知晓!</a>
                                        <span>
                                            04-02</span>
                                    </div>
                                
                                   <div class="Bpwen1"><a href="/newsnotice.aspx?id=62">
                                        欢迎老客户 提出宝贵意见 , 发现BUG请及时提出</a>
                                        <span>
                                            03-20</span>
                                    </div>
                                
                           
                        </div>
                    </dd>
                    <dd class="Dd">
                        <div class="Dd_1"></div>
                        <div class="Dd_2"></div>
                        <div class="Dd_3"></div>
                    </dd>
                </dl>
            </td>
          </tr>
        </tbody></table>

	</div>
</body>
</html>