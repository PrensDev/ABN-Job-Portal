
-- Display all procedure //testing purposes

SELECT 
  ROUTINE_NAME
FROM INFORMATION_SCHEMA.ROUTINES
WHERE ROUTINE_TYPE = 'PROCEDURE' --AND ROUTINE_NAME LIKE 'EMPL_%';
ORDER BY ROUTINE_NAME

----------------------------------------------------------------

-- Get Number of Active Posts
CREATE PROCEDURE [MAIN_RecentPostsNum]
AS 
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
;

-- View Active Posts
CREATE PROCEDURE [VIEW_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT * FROM [Posts]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;

-- View Job Details Procedure
CREATE PROCEDURE [MAIN_JobDetails]
	@jobPostID	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[jobPostID] = @jobPostID AND [JobPosts].[jobPostFlag] = 1
;

-- View Employer Details Procedure
CREATE PROCEDURE [MAIN_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] 
			+ ', ' 
			+ [brgyDistrict] 
			+ ', ' 
			+ [cityProvince] 
			AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
;

-- Get Number of Available Jobs
CREATE PROCEDURE [MAIN_AvailableJobsNum]
	@employerID  INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE [employerID] = @employerID
;

-- View Available Jobs
CREATE PROCEDURE [MAIN_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE [employerID] = @employerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;


-- Get Number of Search Result
CREATE PROCEDURE [MAIN_SearchResultNum]
	@jobTitle VARCHAR(MAX),
	@location VARCHAR(MAX)
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
;

--  Get Search Result
CREATE PROCEDURE [MAIN_GetSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
