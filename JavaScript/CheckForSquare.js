let v = 6;

function CheckPerfectSquare(n)
{
    if (Math.ceil(Math.sqrt(n)) == Math.floor(Math.sqrt(n)))
    {
        return true;
    }
    return false;
}

console.log(CheckPerfectSquare(v));