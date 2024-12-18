<?php
class VoucherService
{
    /**
     * Adds a deposit and increments the deposit count.
     * @return string Confirmation message of the deposit.
     */
    public function addDeposit()
    {

        return "Deposit added. Total deposits this month: ";
    }

    /**
     * Checks if the user is eligible for a voucher.
     * @return string Eligibility message.
     */
    public function checkVoucherEligibility()
    {
        $depositCount = $this->getDepositCount();
        if ($depositCount >= 3) {
            $voucher = bin2hex(random_bytes(5));
            return "Congratulations! You are eligible for a voucher. Your voucher code is: $voucher";
        } else {
            return "Sorry, you are not eligible for a voucher.";
        }
    }

    // this function should be call to
    // database to get the deposit count
    private function getDepositCount()
    {
        return 3;
    }
}
