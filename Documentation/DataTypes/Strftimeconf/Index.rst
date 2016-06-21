.. include:: ../../Includes.txt


.. _data-type-strftime-conf:

strftime-conf
=============

.. container:: table-row

   Data type
         strftime-conf

   Examples
         Date "DD-MM-YY" = ::

            %e:%m:%y

         Time "HH:MM:SS" = ::

            %H:%M:%S

         or just ::

            %T

   Comment
         ==== ==========================================================
         Abb  The abbreviation is expanded to:
         ==== ==========================================================
         %a   abbreviated weekday name according to the current locale
         %A   full weekday name according to the current locale
         %b   abbreviated month name according to the current locale
         %B   full month name according to the current locale
         %c   preferred date and time representation for the current locale
         %C   century number (the year divided by 100 and truncated to an integer, range 00 to 99)
         %d   day of the month as a decimal number (range 00 to 31)
         %D   same as %m/%d/%y
         %e   day of the month as a decimal number, a single digit is preceded by a space (range ' 1' to '31'). Note that the %e modifier is not supported in the Windows implementation of 'strftime'.
         %h   same as %b
         %H   hour as a decimal number using a 24-hour clock (range 00 to 23)
         %I   hour as a decimal number using a 12-hour clock (range 01 to 12)
         %j   day of the year as a decimal number (range 001 to 366)
         %m   month as a decimal number (range 01 to 12)
         %M   minute as a decimal number
         %n   newline character
         %p   either \`am' or \`pm' according to the given time value, or the corresponding strings for the current locale
         %r   time in a.m. and p.m. notation
         %R   time in 24 hour notation
         %S   second as a decimal number
         %t   tab character
         %T   current time, equal to %H:%M:%S
         %u   weekday as a decimal number [1,7], with 1 representing Monday
         %U   week number of the current year as a decimal number, starting with the first Sunday as the first day of the first week
         %V   The ISO 8601:1988 week number of the current year as a decimal number, range 01 to 53, where week 1 is the first week that has at least 4 days in the current year, and with Monday as the first day of the week.
         %W   week number of the current year as a decimal number, starting with the first Monday as the first day of the first week
         %w   day of the week as a decimal, Sunday being 0
         %x   preferred date representation for the current locale without the time
         %X   preferred time representation for the current locale without the date
         %y   year as a decimal number without a century (range 00 to 99)
         %Y   year as a decimal number including the century
         %Z   time zone or name or abbreviation
         %%   a literal \`%' character
         ==== ==========================================================



