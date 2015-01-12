<?php

$user = User::where('dob', '<=', '1987')
            ->where('created_at', '>', '2012-01-01')
            ->take(5)
            ->skip(1)
            ->get();

$item = Item::whereNotNull('upc')->like('name', '%abca%')->get();
