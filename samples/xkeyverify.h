#ifndef XKEY
#define XKEY

#include <winsock2.h>
#include <stdio.h>
#include <windows.h>
#include <wininet.h>

#define MAX_KEY 1024

// https://gist.github.com/augustgl/38d5d849af99fe78063dbfebdce7c153
int get(char *szUrl, char *recv_data, DWORD recv_size) {
	DWORD NumberOfBytesRead = 0;
	RtlZeroMemory(recv_data, recv_size);

	HINTERNET connect = InternetOpen("browser", INTERNET_OPEN_TYPE_PRECONFIG, NULL, NULL, 0);

	if (connect) {
		HINTERNET openAddr = InternetOpenUrl(connect, szUrl, NULL, 0, INTERNET_FLAG_PRAGMA_NOCACHE | INTERNET_FLAG_KEEP_CONNECTION, 0);

		if (openAddr) {
			InternetReadFile(openAddr, recv_data, recv_size, &NumberOfBytesRead);
			InternetCloseHandle(connect);
			InternetCloseHandle(openAddr);
			return NumberOfBytesRead;
		}
		InternetCloseHandle(connect);
	}
	return -1;
}

#endif