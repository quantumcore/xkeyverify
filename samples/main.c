#include "xkeyverify.h"

int main() {
    char* key[MAX_KEY]; memset(key, '\0', MAX_KEY);
    get_key("localhost", "mainkey", key);
    printf("KEY : %s\n", key);
    return 0;
}