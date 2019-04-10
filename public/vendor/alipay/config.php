<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016092100566259",

		//商户私钥
        'merchant_private_key' => "MIIEogIBAAKCAQEArATabtTbfsOTQOmvq36ESQ1IiOs9MJCPZUNV81PWe+LKBPh9khLRvfBavXvHknd0J6EuTXlBKh6z+A189osN5ouBXoOpUKAi/32YM0+okncAjajpG7pwQ9bXEjMLh9QcdcxtbcuKFsWQlsU5Gm2W736LuBg4v9DgNam28SnYoNbhYM4dpEhS4ZTC6Xo7cOyhjPN9eBfFPLp8+HLLL4S3sl7iQ/sjD5GJBMWXyqjTusfdMR8dy+uvvBBzLldI2E+lxV4gu/R30BCBwcX4oY5mAkftz7/TPZk7aMV3AGPKrXnJqa0gyCfbS+gT+97kq+v4x3oQ6Bpb4fV86udX7icltQIDAQABAoIBADsKl2Z/DK9ftUUMcE0uaX0hYAoOo7vtgipBiFiyJ+Xxm2FFYOQoLXFB9AMhXwh4k5eejOPugF1SmHbFOmTsqWK98zNbgVu4+woyM3E5ICTVT41PsmLgBPRj4wHOH2EJfpM4DT8oI0dZnB0DqGvXvXyKNK6FMcU0jiAdFjuEH2RkjEIMWdEdV/9N/iCksODCIWMSomo9J2d3ShRKUWozq+gLPAqxZSfJJ/kF1u6mNdEXu/G/BFEZBP2clztnYiwcVHJ99TH2p26TQRQea9wiaoD5yBRt2LKBzGFtDa44FZ8dZSKrDG7yvkJyGHn3nZ6lYEIIz2roufPIms0vNvSCg6kCgYEA3g5mCiPLrrhgtrJdYPh1JuD2RyWbhurmtqZYF/pCXR6v7OAJIEwNGE0dlZ+ay3X5V2opCs7Y4Fk+Xc3uHkm/32f6qRnNPclZDVQiuGOzNPDNESNx3hS7GaSzm30wYnpy/JTKwBSAXYFkXbgINti6TWze3BrRR2TD2djnx/AXLv8CgYEAxlBfs5FXDJV7AI3ZEyFqL0tdouKd6XUN6b4ai0c6f/RoSGFPuN22Yc53L298a765HWX2h1g9yHWUuzfGOHhRWyvDerrZ72B7DKR0EPtvRYPgaZCsOTZ/C+abB3k2DJfH3MN8k0FgpLkBu4uDjull5aFh/WFqnvE0HIGHsrrUn0sCgYAArXqSPVm5xsZEyHaQfTGeVMFrpim7V6wskoViTVk2f4l555UfjBveHx4f/sSyKkIAikplxgvTY3JVRvObFA6J1/9j1LhTn/GtoLwaY/OADdwSWVFXpCiOA3qo1tD2+/it3KZhv65Emsh7oLwlrrOi2No1Qb+xwBT47TiH26u2cQKBgD0jEh3dtKRggOcO09kd+ApUha1th5ktSPjCbpR5hQNlabDGrzkiwNMuP3gUOptM1OzHPlVDUui1twBwlV9bWFlvCHiRmhY9/DFNkaqamRcpLMnem/mXX1tf4HNRXuRK9oaMjZ8oDI87qdkTjZ9FPPCp6/edTK1rVtFi7V6gUmQ5AoGABjlr/K1+CLsYW95LEXQyAV3YzgYZVPJOwwjhPbFryYmoeStPMI868FD7KzF65ZKEYoTcYdWDcQP/sJVe0AThoDmAENDXNvk7UnBZKOOWRpk5igpGerZDPKz1Qir6Gi8b0xM2Me12QOWZ3ileAuVCC54qtqz7QD3+BcoH0S13sn8=",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
//		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4PpgR0wr+sBqawVBEagoreJr71QxV4uFuQNoURvECagWlUrX3PZQs8dS1BpNjTY8oGI1cQOOErdDqKMoH5J6X3tHkK8x5XnVAWgyj9ZAmByCnh7ArV4XiLFiIJUswcxdk7vttgZZ7XHugbokAyf0CCLB1sLNjVItyVAbO93dpoXLpc83v92jinj9KjMvpy9KrSNd+T8f5qFcgSvB0jmmLa3hufolcUm8tR3GQpqyhGRxq+1VKKeQX9/A4bZDnHpj/X8xC0q27KwqzwzdI7m+GrKYIREbmGfo/BsK4WqOqGXqMqfmfgATYAT082Nfh5nbgxA7N6d7xbXea5SMlfEDDwIDAQAB",

);