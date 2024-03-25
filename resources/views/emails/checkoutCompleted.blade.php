<html>
	<head></head>
	<body>
        <div>
            <h1> Chechout Completed</h1>
            <p> Hi {{ $order->customer->name }}!</p>
            <p> Here is your discount code: {{ $coupon->name }}</p>
        </div>
    </body>
</html>